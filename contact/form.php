<?php
            $to = "group9@atombody.at";   
                $subject = $_POST['subject'];
                $message = $_POST['message'];
                mail($to, $subject, $message);
            
            if(mail($to, $subject, $message)){
                echo 'Your mail has been sent successfully.';
            } else{
                echo 'Unable to send email. Please try again.';
            }

            


?>