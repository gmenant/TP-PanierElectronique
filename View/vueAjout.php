<?PHP
$no_article = $_POST['id'];
$type_article = $_POST['type'];
?>
<table class="centrer tabProduit">
<?PHP
AfficheDetailsArticle($no_article,$type_article,ArticleAAjouter($no_article,$type_article))

?>
</table>




