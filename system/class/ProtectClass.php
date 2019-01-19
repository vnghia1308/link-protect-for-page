<?php
/* >_ Developed by Vy Nghia */
class Database
{
	protected $dbhost;
	protected $dbuser;
	protected $dbpass;
	protected $dbname;
	
	public function dbhost($dbhost)
	{
		$this->dbhost = $dbhost;
	}
	
	public function dbuser($dbuser)
	{
		$this->dbuser = $dbuser;
	}
	
	public function dbpass($dbpass)
	{
		$this->dbpass = $dbpass;
	}
	
	public function dbname($dbname)
	{
		$this->dbname = $dbname;
	}
	
	public function connect()
	{
		global $db;
		
		$db = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass);
		mysqli_select_db($db, $this->dbname);
	}
	
	public function dbinfo($db)
	{
		echo $this->$db;
	}
}

class Protect
{
	public $id;
	public $target_id;
	public $target_type;
	
	public function setCreatorID($userID)
	{
		$this->id = $userID;
	}
	
	public function getUserInfo($accessToken)
	{
		global $userID, $userName, $CreatorID, $CreatorName;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch,CURLOPT_URL, 'https://graph.facebook.com/me?access_token='.$accessToken);
		$getUserJson = curl_exec($ch);
		curl_close($ch);
		$user = json_decode($getUserJson);
		$userID = $user->id;
		$userName = $user->name;
				
		if($this->id !== null)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch,CURLOPT_URL, 'https://graph.facebook.com/'.$this->id.'?access_token='.$accessToken);
			$CreatorApi = curl_exec($ch);
			curl_close($ch);
			$crt = json_decode($CreatorApi);
			$CreatorID = $crt->id;
			$CreatorName = $crt->name;
		}
	}
	
	public function fetchHash($db, $Hash)
	{
		global $URL;
		$Select = mysqli_query($con, "SELECT * FROM `link` WHERE `Hash` = '$Hash'");
		$URL = mysqli_fetch_array($Select);
	}
	
	public function setTargetID($target_id)
	{
		$this->target_id = $target_id;
	}
	
	public function ProtectAnalysis($accessToken)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch,CURLOPT_URL, 'https://graph.facebook.com/'.$this->target_id.'?access_token='.$accessToken);
		$idjson = curl_exec($ch);
		curl_close($ch);
		$iddata = json_decode($idjson);
		
		if(isset($iddata->privacy))
			$this->target_type = 'group';
		else
			$this->target_type = 'page';
	}

	public function Check($db, $accessToken, $Page_accessToken, $Hashtag, $PostID, $userID, $userName)
	{
		global $FoundPost, $FoundPostID, $FoundPostURL, $Liked, $tagsCount, $Joined, $Groups;

		
		/* don't support for group
		if($this->target_type == 'group')
		{
			$Groups = true;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch,CURLOPT_URL, 'https://graph.facebook.com/'.$this->target_id.'/members?limit=5000&access_token='.$accessToken);
			$MemberJson  = curl_exec($ch);
			curl_close($ch);
			$MemberData = json_decode($MemberJson);
						
			foreach($MemberData->data as $members)
			{
				if($members->id == $userID)
				{
					$Joined = true;
				}
			}
		}
		*/
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch,CURLOPT_URL, 'https://graph.facebook.com/'.$this->target_id.'/feed?limit=100&access_token='.$accessToken);
		$FeedApi  = curl_exec($ch);
		curl_close($ch);
		$FeedJson = json_decode($FeedApi, true);
				
		//echo $Hashtag;
		
		if(is_array($FeedJson) or is_object($FeedJson))
		{
			foreach($FeedJson['data'] as &$feed) {
				if(strpos(@$feed['message'], $Hashtag) !== FALSE)
				{
					$FoundPost = true;
					$FoundPostID = str_replace($this->target_id.'_', '',$feed['id']);
										
					$data_query = mysqli_query($con, "SELECT * FROM `link` WHERE `Hash` = '{$Hashtag}'");
					$data = mysqli_fetch_array($data_query);

					if($data['PostID'] == 0)
						$feed['id'] = $this->target_id.'_'.$FoundPostID;
					else
						$feed['id'] = $data['TargetID'].'_'.$data['PostID'];

					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_VERBOSE, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
					curl_setopt($ch,CURLOPT_URL, 'https://graph.facebook.com/v2.10/'.$feed['id'].'?fields=id,permalink_url,message&access_token='.$accessToken);
					$PostApi = curl_exec($ch);
					curl_close($ch);
					$PostPage = json_decode($PostApi);
										
					$FoundPostURL = $PostPage->permalink_url;

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_VERBOSE, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
					curl_setopt($ch,CURLOPT_URL, 'https://graph.facebook.com/v2.10/'.$feed['id'].'/reactions?fields=id,name&pretty=0&live_filter=no_filter&limit=5000&access_token='.$Page_accessToken);
					$LikeApi = curl_exec($ch);
					curl_close($ch);
					
						
					$FindLike = json_decode($LikeApi);
					foreach($FindLike->data as $like)
					{
						if($like->name == $userName)
						{
							$Liked = true;
						}
					}
				}
			}
		}
				
		/* will don't apply, just for developer
		if($TagsRequire == 1)
		{
			$tagsCount = 3;
			$CommentsApi = 'https://graph.facebook.com/'.$this->target_id.'_'.$FoundPostID.'/comments?limit=3000&fields=id,from,message,message_tags&access_token='.$accessToken;
			$CommentsJson = json_decode(file_get_contents($CommentsApi));
			
			if(is_array($CommentsJson) or is_object($CommentsJson))
			{
				foreach($CommentsJson->data as &$cmt) 
				{
					if($cmt->from->id == $userID){
						foreach($cmt->message_tags as $tags)
						{
							$tagsCount--;
						}
					}
				}
			}
		} */
	}
}

class CreateLink
{
	public $GoogleApiKey;
	
	public function setGoogleApiKey($Key)
	{
		$this->GoogleApiKey = $Key;
	}
	
	public function getShortenedLink($Link)
	{
		$longUrl = $Link;
		$apiKey  = $this->GoogleApiKey;

		$postData = array('longUrl' => $longUrl);
		$jsonData = json_encode($postData);

		$curlObj = curl_init();

		curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$apiKey);
		curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObj, CURLOPT_HEADER, 0);
		curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		curl_setopt($curlObj, CURLOPT_POST, 1);
		curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

		$reply = curl_exec($curlObj);

		$json = json_decode($reply);

		curl_close($curlObj);

		if(isset($json->error))
		{
			return $json->error->message;
		} 
		else
		{
			return $json->id;
		}
	}
	
	public function insertLink($db, $fbid, $hash, $targetid, $password, $link, $shortlink, $time)
	{
		mysqli_query($con, "INSERT INTO `link` (`id`, `user`, `password`, `TargetID`, `PostID`, `Hash`, `Url`, `SUrl`,  `time`) VALUES ('', '$fbid', '$password', '$targetid', '0', '$hash', '$link', '$shortlink', '$time')");	
	}
	
	public function deleteLink($con, $id)
	{
		mysqli_query($con, "DELETE FROM link WHERE id='$id'");
	}
}
