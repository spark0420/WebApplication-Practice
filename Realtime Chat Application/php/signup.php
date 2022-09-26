<?php 
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //to check if user email is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //to check if the email already exist in the database
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                //if email already exists
                echo "$email - already exists!";
            }else{
                //to check user upload file or not
                //$FILES['file'] -> returns array with file name, file type, error, file size, tmp_name
                if(isset($_FILES['image'])){ //if file is uploaded
                     //getting user uploaded img name
                    $img_name = $_FILES['image']['name'];
                    //getting user uploaded img type
                    $img_type = $_FILES['image']['type']; 
                    //the temporary name is used to save/remove file in the folder
                    $tmp_name = $_FILES['image']['tmp_name'];
                    

                    //to control the extension of img file
                    $img_explode = explode('.', $img_name);

                    //get the extention type
                    $img_ext = end($img_explode); 
                    $extensions = ['png', 'jpeg', 'jpg', 'JPG'];
                    

                    if(in_array($img_ext, $extensions) === true){
                        //to rename the file name with current time to have unique id
                        $time = time(); 
                        //to move the img to a particular file
                        $new_img_name = $time.$img_name;
                        //$tmp_dir = "Users/scarlettpark/Applications/XAMPP/xamppfiles/htdocs/ChatApp/php/userimages/";

                        //location of the current file, destination
                        if(move_uploaded_file($tmp_name, "userimages/".$new_img_name)){
                            //once signed up, status changes to active
                            $status = "Active now";
                            //to creat radom id for user
                            $random_id = rand(time(), 10000000);
                            
                            //to insert all user data inside the table
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}',
                            '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                            if($sql2){
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    // using this session we used user unique id in other php files
                                    $_SESSION['unique_id'] = $row['unique_id']; 
                                    echo "success!";
                                }
                            }else{
                                echo "something went wrong!";
                            }
                        }else{
                            
                        }

                    }else{  
                        echo "Please select an image file - png, jpeg, jpg, JPG!";
                    }
                }else{
                    echo "Please select an Image file!";
                }
            }
        }else{
            echo "$email - This is not a valid email address!";
        }
    }else{
        echo "All input fields are required!";
    }
?>