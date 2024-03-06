<?php
// Initialise la variable marque avec les marques sélectionnées
// et avec toutes les marques si aucunes n'est sélectionné
function init_marque($pdo){
  if(isset($_POST['marque'])) {
    // Convertir les valeurs sélectionnées en une chaîne de caractères séparée par des virgules
    $marques = implode(",", $_POST['marque']);
  } else {
    $sql = $pdo->query("SELECT id_marque FROM Marques");
    $tableau = $sql->fetchAll(PDO::FETCH_ASSOC);
    $marque_ids = array_column($tableau, 'id_marque');
    $marques = implode(',', $marque_ids);
  }
  return $marques;
}

// Permet de trier par ordre alphabétique ou non
function tri($requete)
{
  if (isset($_SESSION['mode_tri'])){
    if ($_SESSION['mode_tri'] == 'nom-asc'){
      $requete = $requete.' ORDER BY nom_article ASC';
    } elseif ($_SESSION['mode_tri'] == 'nom-desc'){
      $requete = $requete.' ORDER BY nom_article DESC';
    }elseif ($_SESSION['mode_tri'] == 'prix-asc'){
      $requete = $requete.' ORDER BY prix ASC';
    }elseif ($_SESSION['mode_tri'] == 'prix-desc'){
      $requete = $requete.' ORDER BY prix DESC';
    }elseif ($_SESSION['mode_tri'] == 'marque'){
      $requete = $requete.' ORDER BY nom_marque ASC';
    }}
    return $requete;
}

// Sélectionne tous les articles avec les attributs utilisés
function select_preview_ligne($pdo)
{
  $marques = init_marque($pdo);
  // construction de la requête
  $sql = 'SELECT m.nom_marque, a.id_article, v.nom_vendeur, a.nom_article, a.description, a.prix, a.genre, ROUND(AVG(note_article), 1) AS note_moyenne, (SELECT i.lien_image FROM Image AS i WHERE i.id_article = a.id_article ORDER BY i.id_article ASC LIMIT 1) as lien_image from Article AS a JOIN Marques AS m ON a.id_marque = m.id_marque JOIN Vendeur v ON a.id_vendeur = v.id_vendeur LEFT JOIN Feedback f ON a.id_article = f.id_article LEFT JOIN Image AS i ON a.id_article = i.id_article WHERE a.id_marque IN('.$marques.') GROUP BY a.id_article';
  $sql = tri($sql);
  // préparation et exécution de la requête
  $query = $pdo->prepare($sql);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    // récupération des données dans un tableau
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }
  
  // renvoie le tableau
  return $tableau;
}

// Sélectionne les articles selon les catégories
function select_preview_ligne_cat($pdo, $id)
{
  $marques = init_marque($pdo);

  // construction de la requête
  $sql = 'SELECT m.nom_marque, a.id_article, a.nom_article, a.description, a.prix, a.genre, c.nom_cat, ROUND(AVG(note_article), 1) AS note_moyenne, (SELECT i.lien_image FROM Image AS i WHERE i.id_article = a.id_article ORDER BY i.id_article ASC LIMIT 1) as lien_image from Article AS a INNER JOIN Marques AS m ON a.id_marque = m.id_marque INNER JOIN Categorie AS c ON a.id_cat = c.id_cat LEFT JOIN Feedback f ON a.id_article = f.id_article WHERE a.id_cat = :id AND a.id_marque IN('.$marques.') GROUP BY a.id_article';
  $sql = tri($sql);

  // préparation et exécution de la requête
  $query = $pdo->prepare($sql);
  $query->bindValue(':id',$id,PDO::PARAM_STR);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
    $num_results = count($tableau);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  return $tableau;
}

// Affiche le nom de la catégorie sélectionnée
function show_cat($pdo, $id){
  // construction de la requête
  $sql = 'SELECT nom_cat FROM Categorie WHERE id_cat = :id';

  // préparation et exécution de la requête
  $query = $pdo->prepare($sql);
  $query->bindValue(':id',$id,PDO::PARAM_STR);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    $tableau = $query->fetch(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}

// Sélectionne l'article dans la page d'un article en particulier
function select_article($pdo, $id){
  // construction de la requête
  $sql = 'SELECT m.nom_marque, a.id_article, a.nom_article, a.description, a.prix, a.genre, v.nom_vendeur, c.nom_cat, (SELECT i.lien_image FROM Image AS i WHERE i.id_article = a.id_article ORDER BY i.id_article ASC LIMIT 1) as lien_image from Article AS a INNER JOIN Marques AS m ON a.id_marque = m.id_marque INNER JOIN Categorie AS c ON a.id_cat = c.id_cat INNER JOIN Vendeur AS v ON a.id_vendeur = v.id_vendeur WHERE a.id_article = :id GROUP BY a.id_article';

  // préparation et exécution de la requête
  $query = $pdo->prepare($sql);
  $query->bindValue(':id',$id,PDO::PARAM_STR);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    $tableau = $query->fetch(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}

// Sélectionne toutes les images disponibles pour chaque article
function show_image($pdo, $id){
  // construction de la requête
  $sql = 'SELECT a.id_article, i.lien_image FROM Article AS a INNER JOIN Marques AS m ON a.id_marque = m.id_marque INNER JOIN Categorie AS c ON a.id_cat = c.id_cat LEFT JOIN Image AS i ON a.id_article = i.id_article WHERE a.id_article = :id';

  // préparation et exécution de la requête
  $query = $pdo->prepare($sql);
  $query->bindValue(':id',$id,PDO::PARAM_STR);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }
  // renvoie la valeur
  return $tableau;
}

// Selectionne tous les articles dans le panier pour le client
function select_favoris($pdo, $id_client){
  // construction de la requête
  $sql = "SELECT a.id_article FROM Favoris AS f INNER JOIN Article AS a ON f.id_article = a.id_article WHERE f.id_client = :id_client";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id_client',$id_client,PDO::PARAM_STR);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}

//  Sélectionne toutes les infos de l'article dans le panier du client
function select_article_favoris($pdo, $id_client){
  // construction de la requête
  $sql = "SELECT m.nom_marque, a.id_article, a.nom_article, a.description, a.prix, a.genre, IFNULL(f.count, 0) as count, ROUND(AVG(fe.note_article), 1) AS note_moyenne, (SELECT i.lien_image FROM Image AS i WHERE i.id_article = a.id_article ORDER BY i.id_article ASC LIMIT 1) as lien_image 
  FROM Article a 
  JOIN Marques m ON a.id_marque = m.id_marque 
  LEFT JOIN (
    SELECT id_article, COUNT(*) as count 
    FROM Favoris f JOIN Client c ON c.id_client = f.id_client WHERE c.id_client = :id_client
    GROUP BY f.id_article
  ) f ON a.id_article = f.id_article 
  LEFT JOIN Feedback fe ON fe.id_article = a.id_article 
  WHERE a.id_article IN (
    SELECT id_article 
    FROM Favoris 
    WHERE id_client = :id_client
  )
  GROUP BY a.id_article;";
  // SELECT m.nom_marque, a.id_article, a.nom_article, a.description, a.prix, a.genre, COUNT(a.id_article) as count, ROUND(AVG(fe.note_article), 1) AS note_moyenne, (SELECT i.lien_image FROM Image AS i WHERE i.id_article = a.id_article ORDER BY i.id_article ASC LIMIT 1) as lien_image 
  // FROM Article a 
  // JOIN Favoris f ON a.id_article = f.id_article 
  // JOIN Marques m ON a.id_marque = m.id_marque 
  // JOIN Client c ON c.id_client = :id_client
  // LEFT JOIN Feedback fe ON fe.id_article = a.id_article
  // GROUP BY a.id_article
  $query = $pdo->prepare($sql);
  $query->bindValue(':id_client',$id_client,PDO::PARAM_STR);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }
  // renvoie la valeur
  return $tableau;
}

// Sélectionne tous les commentaires disponibles pour un commentaire
function select_article_commentaire($pdo, $id){
  // construction de la requête
  $sql = " SELECT f.*, c.username FROM Feedback f JOIN Client c ON f.id_client = c.id_client WHERE f.id_article = :id ORDER BY f.date DESC";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id',$id,PDO::PARAM_STR);
  $query->execute();


  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }
  // renvoie la valeur
  return $tableau;
}

// Sélectionne tous les commentaires disponibles pour les marques et genre sélectionnés
function select_article_genre_marque($pdo){
  $genre ='';
  $marques = init_marque($pdo);
  if (isset($_SESSION['genre'])){
    $genre = $_SESSION['genre'];
  }

  if ($genre == '' || $genre == 'Tous'){
    $sql = "SELECT m.nom_marque, a.id_article, a.nom_article, a.description, a.prix, a.genre, c.nom_cat, ROUND(AVG(note_article), 1) AS note_moyenne, (SELECT i.lien_image FROM Image AS i WHERE i.id_article = a.id_article ORDER BY i.id_article ASC LIMIT 1) as lien_image from Article AS a INNER JOIN Marques AS m ON a.id_marque = m.id_marque INNER JOIN Categorie AS c ON a.id_cat = c.id_cat LEFT JOIN Feedback f ON a.id_article = f.id_article WHERE a.id_marque IN($marques) GROUP BY a.id_article";
  } else {
    $sql = "SELECT m.nom_marque, a.id_article, a.nom_article, a.description, a.prix, a.genre, c.nom_cat, ROUND(AVG(note_article), 1) AS note_moyenne, (SELECT i.lien_image FROM Image AS i WHERE i.id_article = a.id_article ORDER BY i.id_article ASC LIMIT 1) as lien_image from Article AS a INNER JOIN Marques AS m ON a.id_marque = m.id_marque INNER JOIN Categorie AS c ON a.id_cat = c.id_cat LEFT JOIN Feedback f ON a.id_article = f.id_article WHERE a.id_marque IN($marques) AND a.genre = '$genre' GROUP BY a.id_article";
  }
  $sql = tri($sql);

  // construction de la requête
  $query = $pdo->prepare($sql);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}

// Sélectionne tous les commentaires disponibles pour les marques et genre sélectionnés pour chaque catégories
function select_article_genre_marque_cat($pdo, $id){
  $genre ='';
  $marques = init_marque($pdo);
  if (isset($_SESSION['genre'])){
    $genre = $_SESSION['genre'];
  }

  if ($genre == '' || $genre == 'Tous'){
    $sql = "SELECT m.nom_marque, a.id_article, a.nom_article, a.description, a.prix, a.genre, c.nom_cat, ROUND(AVG(note_article), 1) AS note_moyenne, (SELECT i.lien_image FROM Image AS i WHERE i.id_article = a.id_article ORDER BY i.id_article ASC LIMIT 1) as lien_image from Article AS a INNER JOIN Marques AS m ON a.id_marque = m.id_marque INNER JOIN Categorie AS c ON a.id_cat = c.id_cat LEFT JOIN Feedback f ON a.id_article = f.id_article WHERE a.id_cat = :id AND a.id_marque IN($marques) GROUP BY a.id_article";
  } else {
    $sql = "SELECT m.nom_marque, a.id_article, a.nom_article, a.description, a.prix, a.genre, c.nom_cat, ROUND(AVG(note_article), 1) AS note_moyenne, (SELECT i.lien_image FROM Image AS i WHERE i.id_article = a.id_article ORDER BY i.id_article ASC LIMIT 1) as lien_image from Article AS a INNER JOIN Marques AS m ON a.id_marque = m.id_marque INNER JOIN Categorie AS c ON a.id_cat = c.id_cat LEFT JOIN Feedback f ON a.id_article = f.id_article WHERE a.id_cat = :id AND a.id_marque IN($marques) AND a.genre = '$genre' GROUP BY a.id_article";
  }
  $sql = tri($sql);

  // construction de la requête
  $query = $pdo->prepare($sql);
  $query->bindValue(':id',$id,PDO::PARAM_STR);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}
