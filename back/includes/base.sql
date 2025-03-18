create database designova;
use designova;

-- Table pour les catégories d'articles
CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,        -- Identifiant unique pour chaque catégorie
  name VARCHAR(100) NOT NULL,                -- Nom de la catégorie (par exemple "SEO", "UX/UI", "Marketing digital")
  description TEXT                           -- Description optionnelle de la catégorie
);

-- Table pour les articles
CREATE TABLE articles (
  id INT AUTO_INCREMENT PRIMARY KEY,        -- Identifiant unique pour chaque article
  title VARCHAR(255) NOT NULL,               -- Titre de l'article
  content TEXT NOT NULL,                     -- Contenu de l'article
  author VARCHAR(100),                       -- Auteur de l'article
  category_id INT,                           -- Référence à la catégorie de l'article
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date de création
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Dernière mise à jour
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL -- Lien vers la catégorie
);

-- Table pour les avis sur les articles
CREATE TABLE avis (
  id INT AUTO_INCREMENT PRIMARY KEY,        -- Identifiant unique pour chaque avis
  article_id INT NOT NULL,                   -- Référence à l'article concerné
  name VARCHAR(100) NOT NULL,                -- Nom de l'utilisateur qui a laissé l'avis
  rating INT NOT NULL,                       -- Note de l'article (1 à 5)
  review TEXT,                               -- Commentaire de l'utilisateur
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date d'envoi de l'avis
  FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE -- Lien vers l'article
);

-- Table pour les messages de contact des utilisateurs
CREATE TABLE contact (
  id INT AUTO_INCREMENT PRIMARY KEY,        -- Identifiant unique pour chaque message
  name VARCHAR(100) NOT NULL,                -- Nom de l'utilisateur
  email VARCHAR(100) NOT NULL,               -- Email de l'utilisateur
  message TEXT NOT NULL,                     -- Message envoyé par l'utilisateur
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Date d'envoi du message
);

