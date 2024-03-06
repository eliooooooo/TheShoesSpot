<?php
// compte le nombre d'articles par marques
function count_marques($pdo)
{
  // construction de la requête
  $sql = 'SELECT m.id_marque, m.nom_marque, COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque GROUP BY m.nom_marque';

  // préparation et exécution de la requête
  $query = $pdo->prepare($sql);
  $query->execute();

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    // récupération de la première ligne
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}

// compte le nombre d'articles par marque par catégories
function count_marques_cat($pdo, $id)
{
  // construction de la requête
  if ($id == 0) {
    $sql = 'SELECT m.nom_marque, m.id_marque, COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque GROUP BY m.nom_marque ORDER BY COUNT(a.id_article) DESC';
    $query = $pdo->prepare($sql);
    $query->execute();
  } else {
    $sql = 'SELECT m.nom_marque, m.id_marque, COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque WHERE a.id_cat = :id GROUP BY m.nom_marque ORDER BY COUNT(a.id_article) DESC';
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->execute();
  }

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    // récupération de la première ligne
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}

// compte le nombre d'articles par catégories
function count_categorie($pdo)
{
  // construction de la requête
  $sql = 'SELECT c.id_cat, c.nom_cat, COUNT(a.id_article) AS nombre_articles FROM Categorie c INNER JOIN Article a ON c.id_cat = a.id_cat GROUP BY c.id_cat';

  // préparation et exécution de la requête
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

// compte le nombre d'articles de tout si on n'a pas sélectionné de catégorie
// compte le nombre d'article d'une catégorie si on en a sélectionné une
function count_all($pdo, $id)
{
  $marques = init_marque($pdo);

  // construction de la requête
  if ($id == 0) {
    $sql = 'SELECT COUNT(id_article) AS nombre_articles FROM Article AS a WHERE a.id_marque IN('.$marques.')';
    $query = $pdo->prepare($sql);
    $query->execute();
  } else {
    $sql = 'SELECT COUNT(id_article) AS nombre_articles FROM Article AS a WHERE a.id_cat = :id AND a.id_marque IN(' . $marques . ')';
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->execute();
  }

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

// Compte le montant total du panier et le nombre d'article dedans
function count_panier($pdo, $id_client)
{
  // construction de la requête
  $sql = 'SELECT SUM(a.prix) AS somme_prix, COUNT(f.id_article) AS nb_favoris, ROUND(SUM(a.prix)/COUNT(f.id_article), 2) AS prix_moyen FROM Article a JOIN Favoris f ON f.id_article = a.id_article WHERE id_client = :id_client';

  // préparation et exécution de la requête
  $query = $pdo->prepare($sql);
  $query->bindValue(':id_client', $id_client, PDO::PARAM_STR);
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

// Calcul la moyenne des notes du produit
function count_moyenne_note($pdo, $id)
{
  // construction de la requête
  $sql = 'SELECT ROUND(AVG(note_article), 1) AS moyenne_note FROM Feedback WHERE id_article = :id';

  // préparation et exécution de la requête
  $query = $pdo->prepare($sql);
  $query->bindValue(':id', $id, PDO::PARAM_STR);
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

// Calcul le nombre d'avis
function count_avis($pdo, $id)
{
  // construction de la requête
  $sql = 'SELECT COUNT(note_article) AS nombre_avis FROM Feedback WHERE id_article = :id';

  // préparation et exécution de la requête
  $query = $pdo->prepare($sql);
  $query->bindValue(':id', $id, PDO::PARAM_STR);
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

// compte le nombre d'articles par marque par catégories par genre
function count_marques_cat_genre($pdo, $id)
{
  $genre = '';
  if (isset($_SESSION['genre'])){
    $genre = $_SESSION['genre'];
  }

  // construction de la requête
  if ($id == 0) {
    if ($genre == '' || $genre == 'Tous'){
      $sql = 'SELECT m.nom_marque, m.id_marque, COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque GROUP BY m.nom_marque ORDER BY COUNT(a.id_article) DESC';
      $query = $pdo->prepare($sql);
      $query->execute();
    } else {
      $sql = 'SELECT m.nom_marque, m.id_marque, COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque WHERE a.genre = :genre GROUP BY m.nom_marque ORDER BY COUNT(a.id_article) DESC';
      $query = $pdo->prepare($sql);
      $query->bindValue(':genre', $genre, PDO::PARAM_STR);
      $query->execute();
  }} else {
    if ($genre == '' || $genre == 'Tous'){
      $sql = 'SELECT m.nom_marque, m.id_marque, COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque WHERE a.id_cat = :id GROUP BY m.nom_marque ORDER BY COUNT(a.id_article) DESC';
      $query = $pdo->prepare($sql);
      $query->bindValue(':id', $id, PDO::PARAM_STR);
      $query->execute();
    } else {
      $sql = 'SELECT m.nom_marque, m.id_marque, COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque WHERE a.id_cat = :id AND a.genre = :genre GROUP BY m.nom_marque ORDER BY COUNT(a.id_article) DESC';
      $query = $pdo->prepare($sql);
      $query->bindValue(':id', $id, PDO::PARAM_STR);
      $query->bindValue(':genre', $genre, PDO::PARAM_STR);
      $query->execute();
  }}

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    // récupération de la première ligne
    $tableau = $query->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}

function count_all_genre($pdo, $id)
{
  $genre = '';
  if (isset($_SESSION['genre'])){
    $genre = $_SESSION['genre'];
  }

  // construction de la requête
  if ($id == 0) {
    if ($genre == '' || $genre == 'Tous'){
      $sql = 'SELECT COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque';
      $query = $pdo->prepare($sql);
      $query->execute();
    } else {
      $sql = 'SELECT COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque WHERE a.genre = :genre';
      $query = $pdo->prepare($sql);
      $query->bindValue(':genre', $genre, PDO::PARAM_STR);
      $query->execute();
  }} else {
    if ($genre == '' || $genre == 'Tous'){
      $sql = 'SELECT COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque WHERE a.id_cat = :id';
      $query = $pdo->prepare($sql);
      $query->bindValue(':id', $id, PDO::PARAM_STR);
      $query->execute();
    } else {
      $sql = 'SELECT COUNT(a.id_article) AS nombre_articles FROM Marques m INNER JOIN Article a ON m.id_marque = a.id_marque WHERE a.genre = :genre AND a.id_cat = :id';
      $query = $pdo->prepare($sql);
      $query->bindValue(':id', $id, PDO::PARAM_STR);
      $query->bindValue(':genre', $genre, PDO::PARAM_STR);
      $query->execute();
  }}

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    // récupération de la première ligne
    $tableau = $query->fetch(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}

function count_all_marque_genre_cat($pdo, $id)
{
  $marque = init_marque($pdo);
  $genre = '';
  if (isset($_SESSION['genre'])){
    $genre = $_SESSION['genre'];
  }

  // construction de la requête
  if ($id == 0) {
    if ($genre == '' || $genre == 'Tous'){
      $sql = 'SELECT COUNT(a.id_article) AS nombre_articles FROM Article a WHERE id_marque IN('.$marque.');';
      $query = $pdo->prepare($sql);
      $query->execute();
    } else {
      $sql = 'SELECT COUNT(a.id_article) AS nombre_articles FROM Article a WHERE a.genre = :genre AND id_marque IN('.$marque.');';
      $query = $pdo->prepare($sql);
      $query->bindValue(':genre', $genre, PDO::PARAM_STR);
      $query->execute();
  }} else {
    if ($genre == '' || $genre == 'Tous'){
      $sql = 'SELECT COUNT(a.id_article) AS nombre_articles FROM Article a WHERE a.id_cat = :id AND id_marque IN('.$marque.');';
      $query = $pdo->prepare($sql);
      $query->bindValue(':id', $id, PDO::PARAM_STR);
      $query->execute();
    } else {
      $sql = 'SELECT COUNT(a.id_article) AS nombre_articles FROM Article a WHERE a.id_cat = :id AND a.genre = :genre AND id_marque IN('.$marque.');';
      $query = $pdo->prepare($sql);
      $query->bindValue(':id', $id, PDO::PARAM_STR);
      $query->bindValue(':genre', $genre, PDO::PARAM_STR);
      $query->execute();
  }}

  // vérification des erreurs
  if ($query->errorCode() == '00000') {
    // récupération de la première ligne
    $tableau = $query->fetch(PDO::FETCH_ASSOC);
  } else {
    echo '<p>Erreur dans la requête : ' . $query->errorInfo()[2] . '</p>';
    $tableau = null;
  }

  // renvoie la valeur
  return $tableau;
}

