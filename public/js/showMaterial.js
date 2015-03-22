
            /**
             * this function to submit the text of comment after edit it
             * @returns {undefined}
             */

            function add(id) {
                //get the body of the comment after edit it
                var body_edit = document.getElementById("bodyEdit_" + id);
                console.log(body_edit.value);

                //open http request to send the parameters of comment to update
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "../../../../public/Comments/edit/", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("id=" + id + "&body=" + body_edit.value +"&materialid=<?php echo $this->materialid; ?>");

                //on change check even the request send or not


                xmlhttp.onreadystatechange = function () {

                    // alert(xmlhttp.readyState);
                    // alert(xmlhttp.status);
                    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    }
                    console.log(xmlhttp.responseText);

                    //append the comment after update
                    var comment_parent = document.getElementById("comment_" + id);
                    
                    var comment_after_edit=document.createElement("p");
                    comment_after_edit.setAttribute("id",id);
                    comment_after_edit.innerHTML=body_edit.value;
                    
                     body_edit.remove();
                    var button_after_edit = document.getElementById("btn_" + id);
                    button_after_edit.remove();
                    
                    comment_parent.appendChild(comment_after_edit);
                };
            }
            /**
             * this function to edit the Comment
             * @returns {undefined}
             */
            function editComment(id) {

                //get the body of the comment and remove it
                var comment = document.getElementById(id);
                var comment_body = comment.innerHTML;
                comment.remove();

                //create a text field by the body of the comment 
                var textfield = document.createElement("input");
                textfield.setAttribute("type", "text");
                textfield.setAttribute("class","form-control");
                textfield.setAttribute("value", comment_body);
                textfield.setAttribute("id", "bodyEdit_" + id);

                //create add button to add the comment
                var button = document.createElement("button");
                button.setAttribute("class", "btn btn-primary");
                button.setAttribute("id", "btn_"+ id);
                button.innerHTML="Add";
                button.setAttribute("onclick", "add("+id+")");

                //append the text area to the parent
                var comment_parent = document.getElementById("comment_" + id);

                comment_parent.appendChild(textfield);
                comment_parent.appendChild(button);

            }
            
            

