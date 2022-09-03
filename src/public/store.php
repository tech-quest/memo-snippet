<?php
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $dbUserName,
    $dbPassword
);

$content = filter_input(INPUT_POST, 'content');
$title = filter_input(INPUT_POST, 'title');

// [解説！]ガード節になっている
if (empty($title) || empty($content)) {
    header('Location: ./create.php');
    exit();
}

$sql = 'INSERT INTO `pages`(`title`, `content`) VALUES(:title, :content)';
$statement = $pdo->prepare($sql);
$statement->bindValue(':title', $title, PDO::PARAM_STR);
$statement->bindValue(':content', $content, PDO::PARAM_STR);
$statement->execute();

// [解説！]リダイレクト処理
header('Location: ./index.php');
// [解説！]リダイレクトしても処理が一番下まで続いてしまうので「exit」しておこう！！！
exit();
?>
