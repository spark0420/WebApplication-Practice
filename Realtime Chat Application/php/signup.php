<?php
    //PHP $_SESSION is an associative array that contains all session variables. 
    session_start();
    include_once "config.php";
    //mysqli_real_escape_string: escapes special characters in a string for use in an SQL query,
    //$_POST: collect value of input field
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //checks if the email address is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //checks if the email address is already being used
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This already exists!";
            }else{
                //checks if the user upload file or not
                //isset: Check whether a variable is empty. Also check whether the variable is set/declared
                if(isset($_FILES['image'])){
                    //getting user uploaded img name, type
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name']; //tmp_name is used to save file in our folder

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);

                    $extensions = ['png', 'jpg', 'jpeg', 'JPG'];

                    if(in_array($img_ext, $extensions) === true){
                        $time = time();
                        $new_img_name = $time.$img_name;
                        
                        //move the img file to "images" folder with the new name
                        //if it doesn't work on mac, i need to execute sudo chmod -R 777 
                        //in the folder to grant the access
                        if(move_uploaded_file($tmp_name, "userimages/".$new_img_name)){
                            $status = "Active now";
                            $random_id = rand(time(), 10000000);

                            //insets all user data inside table
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                            if($sql2){ //if these data succssfully inserted
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    //fetches a result row as an associative array
                                    $row = mysqli_fetch_assoc($sql3);
                                    //uses a unique id in other php files
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo "success";
                                }
                            }else{
                                echo "Something went wrong!";
                            }
                        }else{
                            echo "Image upload failed!";
                        }
                    }else{
                        echo "Please upload png, jpg, jpeg, or JPG format!";
                    }
                }else{
                    echo "Please upload an Image File";
                }
            }
        }else{
            echo "$email - This is not a valid email address!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
