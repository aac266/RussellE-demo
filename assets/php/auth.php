<?php
	require_once dirname(__DIR__, 2) . '/config/config.php';

	class Auth extends Database {
	  // Check if user already registered
	  public function user_exist($email) {
	    $sql = 'SELECT email FROM users WHERE email = :email';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['email' => $email]);
	    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	    $user = $result['email'] ?? '';
	    return $user;
	  }

	  //Register New User
	  public function register($name,$email,$password) {
	    $sql = 'INSERT INTO users (name,email,password) VALUES (:name,:email,:password)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
	    return true;
	  }

	  //Login Existing User
	  public function login($email) {
	    $sql = 'SELECT email, password FROM users WHERE email = :email AND deleted != 0';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['email' => $email]);
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);

	    return $row;
	  }

	  //Current User in Session
	  public function currentUser($email) {
	    $sql = 'SELECT * FROM users WHERE email = :email AND deleted != 0';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['email' => $email]);
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);

	    return $row;
	  }

	  //Forgot Password
	  public function forgot_password($token,$email) {
	    $sql = 'UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email AND deleted != 0';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['token' => $token, 'email' => $email]);
	    return true;
	  }

	  //Forgot Password Auth
	  public function reset_pass_auth($email,$token) {
	    $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token <> '' AND token_expire > NOW() AND deleted != 0";
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['email' => $email, 'token' => $token]);
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);

	    return $row;
	  }

	  //Update New Password
	  public function update_new_pass($pass,$email) {
	    $sql = "UPDATE users SET token = '', password = :pass WHERE email = :email AND deleted != 0";
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['pass' => $pass, 'email' => $email]);
	    return true;
	  }

	  //Add New Note
	  public function add_new_note($cid,$title,$note) {
	    $sql = 'INSERT INTO notes (uid, title, note) VALUES (:uid, :title, :note)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['uid' => $cid, 'title' => $title, 'note' => $note]);
	    return true;
	  }

	  //Fetch Note of current logined user
	  public function get_notes($cid) {
	    $sql = 'SELECT * FROM notes WHERE uid = :uid';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['uid' => $cid]);

	    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    return $result;
	  }

	  //Delete Note of current logined user
	  public function delete_note($id) {
	    $sql = 'DELETE FROM notes WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
	    return true;
	  }

	  //Edit note of current logined user
	  public function edit_note($id) {
	    $sql = 'SELECT * FROM notes WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
	    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	    return $result;
	  }

	  //Update note of current logined user
	  public function update_note($id,$title,$note) {
	    $sql = 'UPDATE notes SET title = :title, note = :note, updated_at = NOW() WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['title' => $title, 'note' => $note, 'id' => $id]);
	    return true;
	  }

	  //Verify email
	  public function verify_email($email) {
	    $sql = 'UPDATE users SET verified = 1 WHERE email = :email AND deleted != 0';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['email' => $email]);
	    return true;
	  }

	  //Update Profile
	  public function update_profile($name,$gender,$dob,$phone,$photo,$id) {
	    $sql = 'UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo WHERE id = :id AND deleted != 0';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['name' => $name, 'gender' => $gender, 'dob' => $dob, 'phone' => $phone, 'photo' => $photo, 'id' => $id]);
	    return true;
	  }

	  //Change Password
	  public function change_password($pass,$cid) {
	    $sql = 'UPDATE users SET password = :pass WHERE id = :id AND deleted != 0';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['pass' => $pass, 'id' => $cid]);
	    return true;
	  }

	  //Send Feedback
	  public function send_feedback($sub,$feedback,$cid) {
	    $sql = 'INSERT INTO feedback (uid, subject, feedback) VALUES (:uid, :sub, :feedback)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['uid' => $cid, 'sub' => $sub, 'feedback' => $feedback]);
	    return true;
	  }

	  //Insert Notification
	  public function notification($cid,$type,$message) {
	    $sql = 'INSERT INTO notification (uid, type, message) VALUES (:uid, :type, :message)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['uid' => $cid, 'type' => $type, 'message' => $message]);
	    return true;
	  }

	  //Fetch Notification
	  public function fetchNotification($cid) {
	    $sql = "SELECT * FROM notification WHERE uid = :uid AND type = 'user'";
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['uid' => $cid]);
	    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	    return $result;
	  }

	  //Remove notification
	  public function removeNotification($id) {
	    $sql = "DELETE FROM notification WHERE id = :id AND type = 'user'";
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);

	    return true;
	  }

	  
	}
?>
<?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'user_system');

$sql = "SELECT * FROM upload";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'upload' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO upload (name, size, downloads) VALUES ('$filename', $size, 0)";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}