<?php
include('../init.php');
$max = 400*1024;
$message ="";

if (isset($_POST['key'])) {

		if ($_POST['key'] == 'viewOReditcomment') {
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT image,title, athors, textarea, email, date, address, country, state FROM comment WHERE post_id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArrays = array(
				'image' => $data['image'],
				'title' => $data['title'],
				'athors' => $data['athors'],
				'textarea' => $data['textarea'],
				'email' => $data['email'],
				'date' => $data['date'],
				'address' => $data['address'],
				'country' => $data['country'],
				'state' => $data['state'],
			);

			exit(json_encode($jsonArrays));
 		}

		if ($_POST['key'] == 'fetch_array') {
			$begin_nmber = $conn->real_escape_string($_POST['begin_nmber']);
			$end_nmber = $conn->real_escape_string($_POST['end_nmber']);

			$sql = $conn->query("SELECT * FROM comment WHERE approved='on' ORDER BY date DESC LIMIT $begin_nmber, $end_nmber ");
			if ($sql->num_rows > 0) {
				$response = "";
				$increment=0;
				while($row = $sql->fetch_array()) {
				   $increment++;
					$response .= '
						<tr>
							<td>'.$increment.'</td>
							<td>'.$row["post_comment"].'</td>
							<td  style="width:100px;"id="title'.$row["post_id"].'">
							'.
                            (strlen($row["title"]) > 20 ?
                              $row["title"] = substr($row["title"],0,10)."..."
                            : $row["title"])
							.'
							</td>
							<td  style="width:100px;"id="image'.$row["post_id"].'">
							<img width = "60px"  src="'.BASE_URL_LINK_ALL.'image/uploads_commets/'.$row["image"].'"></td>
							<td  style="width:100px;"id="athors'.$row["post_id"].'">
							'.
                            (strlen($row["athors"]) > 20 ?
                              $row["athors"] = substr($row["athors"],0,10)."..."
                            : $row["athors"])
							.'
							</td>
							<td  style="width:100px;"id="textarea'.$row["post_id"].'">
							'.
                            (strlen($row["textarea"]) > 20 ?
                            $row["textarea"] = substr($row["textarea"],0,10)."..."
                            : $row["textarea"])
							.'
							</td>
							<td  style="width:100px;"id="date'.$row["post_id"].'">'.$row["date"].'</td>
 						    <td>
								<input type="button" onclick="viewOReditcomment_('.$row["post_id"].', \'edit\')" value="Edit" class="btn btn-primary">
								<input type="button" onclick="viewOReditcomment_('.$row["post_id"].', \'view\')" value="View" class="btn">
								<input type="button" onclick="deleteRowcomment_('.$row["post_id"].')" value="Delete" class="btn btn-danger">
								<input type="button" onclick="un_approved('.$row["post_id"].')" value="Un-Approved" class="btn btn-warning">
							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('Max');
		}

		$rowID = $conn->real_escape_string($_POST['rowID']);

		if ($_POST['key'] == 'deleteRowcomment') {
			$conn->query("DELETE FROM comment WHERE post_id='$rowID'");
			exit('The Row Has Been Deleted!');
		}

          if ($_POST['key'] == 'un_approved') {
			$conn->query("UPDATE comment SET approved='off' WHERE post_id='$rowID'");
			exit('success');
		}
		   
		$title = $conn->real_escape_string($_POST['title']);
		$athors = $conn->real_escape_string($_POST['athors']);
		$textarea = $conn->real_escape_string($_POST['textarea']);
		$email = $conn->real_escape_string($_POST['email']);
		$date = $conn->real_escape_string($_POST['date']);
		$address = $conn->real_escape_string($_POST['address']);
		$country = $conn->real_escape_string($_POST['country']);
		$state = $conn->real_escape_string($_POST['state']);
		// $approved = $conn->real_escape_string($_POST['approved']);
		// $fileName = $conn->real_escape_string($_POST['image']);
		
		if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE comment SET title='$title', athors='$athors', textarea='$textarea',
			email='$email', date='$date', address='$address', country='$country', state='$state' WHERE post_id='$rowID'");
			exit('success');
		}
		
		
		if ($_POST['key'] == 'addcomment') {
		    	$sql = $conn->query("SELECT * FROM comment WHERE title = '$title'");
		    	if ($sql->num_rows > 0){
		    	   exit("Country With This Name Already Exists!");
		    	}else {
		            $conn->query("INSERT INTO comment (title, athors, textarea, email, date, address, country, state) 
		    		VALUES ('$title','$athors', '$textarea','$email','$date','$address','$country','$state')");
		            exit('Country Has Been Inserted!');
		    	}
			}
			$conn->close();
	}
?>
 