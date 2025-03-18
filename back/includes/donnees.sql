INSERT INTO categories (name, description) VALUES
('SEO', 'Optimisation des moteurs de recherche pour améliorer la visibilité en ligne.'),
('UX/UI', 'Design d\'interface utilisateur et expérience utilisateur pour une navigation fluide.'),
('Marketing digital', 'Stratégies de marketing utilisant les canaux numériques pour promouvoir des produits ou services.'),
('Design Graphique', 'La catégorie dédiée aux articles portant sur le design graphique, les tendances du visuel et les meilleures pratiques du design.');


-- Insérer des articles en lien avec les catégories
INSERT INTO articles (title, content, author, category_id) VALUES
('Les tendances SEO en 2025', 'Découvrez les dernières tendances SEO pour 2025, avec des stratégies avancées et des astuces pratiques pour améliorer votre classement.', 'John Doe', 1),
('Introduction à UX/UI Design', 'Cet article explore les bases du design d\'interface utilisateur et de l\'expérience utilisateur pour créer des sites web attractifs et fonctionnels.', 'Jane Smith', 2),
('Comment réussir sa campagne de marketing digital', 'Apprenez les meilleures pratiques pour créer une campagne de marketing digital efficace, y compris les stratégies de contenu et les publicités ciblées.', 'Alice Johnson', 3);


-- Insérer des avis pour les articles
INSERT INTO avis (article_id, name, rating, review) VALUES
(1, 'Marie Dupont', 5, 'Excellent article sur les tendances SEO. Les informations sont très utiles pour rester à jour avec les dernières pratiques.'),
(1, 'Paul Martin', 4, 'Bon article, mais j\'aurais aimé plus d\'exemples pratiques pour illustrer les concepts.'),
(2, 'Sophie Laurent', 5, 'Un article très complet qui explique bien l\'importance de l\'UX/UI.'),
(3, 'Luc Bernard', 3, 'L\'article est intéressant, mais il manque des informations sur les outils spécifiques à utiliser pour les campagnes de marketing digital.');

-- Insérer des messages de contact
INSERT INTO contact (name, email, message) VALUES
('Michel Lefevre', 'michel.lefevre@email.com', 'J\'ai une question concernant les tendances SEO de 2025, pourriez-vous me donner plus de détails ?'),
('Clara Dubois', 'clara.dubois@email.com', 'J\'aimerais en savoir plus sur vos services de marketing digital pour mon entreprise.'),
('David Lemoine', 'david.lemoine@email.com', 'Merci pour les articles intéressants sur l\'UX/UI, je cherche un designer pour mon site web.');
