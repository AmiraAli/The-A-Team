
<?php
	class Img
	{
		protected $pass ;
		
		function upload($type , $file)
		{
			if ($file['error'] > 0)
			{
				$ImgError="";
				switch ($_FILES["Img"]['error'])
				{
					case 1:
						$ImgError="*File exceeded upload_max_filesize";
						$flag=false;
						break;
					case 2: 
						$ImgError="*File exceeded max_file_size";
						$flag=false;
						break;
					case 3: 
						$ImgError="*File only partially uploaded";
						$flag=false;
						break;
					case 4: 
						$ImgError="*No file uploaded";
						$flag=false;
						break;
					case 6:
					 	$ImgError="*Cannot upload file: No temp directory specified";
						$flag=false;
						break;
					case 7: 
						$ImgError="*Upload failed: Cannot write to disk";
						$flag=false;
						break;
				}
				echo $ImgError;
				return "Error:".$ImgError;

			}
			else
			{
				
				if($type=="user")
				{
					$this->pass = "../users/";
				}
				else
				{
					$this->pass = "../img/item/";
				}
				$imgextarr = explode('/tmp/',$file['tmp_name']);
				
				$imgext = $imgextarr[count($imgextarr)-1];
				
				$imgname =  explode('.',$file['name']);
				
				$imgext.=".".$imgname[1];
				
				$MoveFileFlag=move_uploaded_file ($file['tmp_name']  , $this->pass.$imgext );
				
				return "success:".$this->pass.$imgext;
			}
		}
	}








?>




