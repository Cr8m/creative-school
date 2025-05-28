<?php
include_once("../controller/config.php");


function generateRandomIndex() {
    return 'T-' . rand(10000, 99999); // You can customize the format
}

function generateUniqueIndex($conn) {
    do {
        $index = generateRandomIndex();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM teacher WHERE index_number = ?");
        $stmt->bind_param("s", $index);
        $stmt->execute();
        $count = 0;
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0);
    
    return $index;
}

echo generateUniqueIndex($conn);
?>
