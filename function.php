
<?php

//@Piyush Patil  Created For getting FileName Extension
function getFileNameExtension($imageName) {
    return pathinfo($imageName, PATHINFO_EXTENSION);
}

//@ Piyush Patil Created For getting Unique FileName 
function getFileUniqueName($param) {
    return date("Yhmids") . uniqid() . "." . $param;
}

?>
