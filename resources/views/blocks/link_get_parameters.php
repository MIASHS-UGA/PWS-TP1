  <h2>Lien avec des paramètres</h2>

  <p>Par défaut, les liens utilisent la méthode HTTP "get". Le lien ci-dessous contient des paramètres. Les paramètres des URL se situent après le caractère ? et sont sous la forme nomParam=ValeurParam et lié avec le caractère &. Ces paramètres seront disponibles côté serveur dans la variable PHP $_GET</p>

  <a href="<?= BASE_URL ?>?parametre1=valeur1&parametre2=valeur2&unAutre=uneVal">Lien avec paramètres</a>