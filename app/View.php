<?php

class View
{
  protected $template; //nom du fichier template de la view, par défaut ce sera template.php
  protected $sections; //tableau contenant les noms et noms de fichier des sections HTML/PHP à afficher dans la template
  protected $data; //tableau de variables à remplir par le controller

  function __construct($data = [], $sections = [], $template = 'template', $render = true)
  {
    $this->data = $data;
    $this->sections = $sections;
    $this->template = $template;
    if ($render) $this->render();
  }

  /** 
   * Generation du HTML de la template
   */
  function render()
  {
    ob_start(); //ouvre un buffer pour capturer un output (l'output peut être du html ou du texte dans les fichiers ainsi que du code php echo)
    extract($this->data); //extrait les variables pour qu'elles soient disponibles dans les templates directement
    require 'resources/views/' . $this->template . '.php'; //inclusion du fichier squelette de la view, par défaut resources/views/template.php
    $str = ob_get_contents(); //récupère l'output généré sous forme de string
    ob_end_clean(); //nettoie et ferme le buffer d'output
    echo $str; //affiche la string générée
  }

  /**
   * Appel de la fonction renderSection() sur toutes les sections de la view
   */
  function renderSections()
  {
    foreach ($this->sections as $section_name => $section_content) {
      echo $this->renderSection($section_name);
    }
  }

  /**
   * Renvoie l'output d'une section
   * Si la section est un nom de fichier et que le fichier existe, on fait un render
   * Sinon si la section est un objet View, on appelle la fonction render() sur l'objet
   */
  function renderSection($section_name)
  {
    if (isset($this->sections[$section_name])) { //Est-ce que cette section est réferencée dans $this->sections ?

      if (is_string($this->sections[$section_name])) { //Est-ce que la valeur contenue dans $this->sections[$section_name] est une string ?

        if (!file_exists('resources/views/' . $this->sections[$section_name] . '.php')) { //Si le fichier n'existe pas, on affiche un message d'erreur
          return 'Erreur template ' . $this->sections[$section_name] . ' non trouvée';
        }

        //Sinon on génère l'affichage, même méthode que dans la fonction render()
        ob_start();
        extract($this->data);
        require 'resources/views/' . $this->sections[$section_name] . '.php';
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
      } elseif (is_a($this->sections[$section_name], 'View')) { //Sinon si la valeur contenu dans $this->sections[$section_name] est un objet de type View
        $this->sections[$section_name]->render(); //On appelle la fonction render()
      }
    }
  }
}
