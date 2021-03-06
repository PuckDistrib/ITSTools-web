<style type="text/css">
<!--
.galElement {
	font-family:Monospace,"Courier New", Courier;
	font-weight:bold;
	color:red
	
}
.codeDescription
{
	 margin-left:25px;
}
.galInterfaceTitle 
{
	color:#003366;
	font-size:17pt;
}
-->
</style>

<div class="feature"> <img src="images/Documentation.png" alt="" width="120" height="73" />
    <b>Bienvenue sur la page de documentation de GAL </b>
    <p> Vous trouverez sur cette page la documentation officielle du langage GAL, toutes ses sp&eacute;cifications, ainsi que de l'aide sur l'installation et l'utilisation.</p>
    <p>&nbsp;</p>
    <p><strong>Sommaire</strong></p>
    <div id="sommaire">
	
	<?php
	TableOfContents(__FILE__, 5); 
	?>
	</div>
	
	</span>
</div>
  <div class="story">
  <br /><br />
    <h2><a name="introduction"></a>1. Introduction</h2>
	
    <p>&nbsp;</p>
    <p>Ce projet s&rsquo;inscrit dans le cadre du PSTL, r&eacute;alis&eacute; au sein de l&rsquo;&eacute;quipe MoVe (Mod&eacute;lisation et V&eacute;rification) du Laboratoire Informatique de l&rsquo;Universit&eacute; Pierre et Marie Curie (LIP6), durant l&rsquo;ann&eacute;e 2012.  Le but du stage est la r&eacute;alisation d&rsquo;un plugin Eclipse qui sera un &eacute;diteur pour le langage GAL. Ce plugin jouit de toute la puissance d&rsquo;Eclipse, notamment l&rsquo;auto-compl&eacute;tion, ou encore la correction automatique..</p>
    <p>Pour atteindre les objectifs, nous nous sommes servis d&rsquo;Eclipse et de Xtext ( <a href="http://www.eclipse.org/Xtext/" target="_blank">http://www.eclipse.org/Xtext/</a> ), un plugin Eclipse qui permet de d&eacute;finir des grammaires pour des langages d&eacute;di&eacute;s &agrave; un domaine sp&eacute;cifique ( <strong>D</strong>omain <strong>S</strong>pecific <strong>L</strong>anguage ) sous tous ses aspects, de mani&egrave;re tr&egrave;s compl&egrave;te.</p>
    <p>Le plugin GAL a &eacute;t&eacute; d&eacute;velopp&eacute; en utilisant des outils de d&eacute;veloppement collaboratif, tels que le gestionnaire de versions SVN (accessible &agrave; l&rsquo;adresse <a href="https://projets-systeme.lip6.fr/svn/research/thierry/PSTL/GAL" target="_blank">https://projets-systeme.lip6.fr/svn/research/thierry/PSTL/GAL</a>), le serveur d&rsquo;int&eacute;gration continu (Teamcity). <br />
    </p>
  </div>
  
<div class="story">
    <p>&nbsp;</p>
    <p><br />
    </p>
    <h2><a name="installation"></a>2. Installation</h2>
  <p><br />
  </p>
    <p>Comme mentionn&eacute;, GAL est un plugin pour l&rsquo;IDE Eclipse. Il requiert donc une installation locale d&rsquo;Eclipse sur votre ordinateur, ainsi qu&rsquo;une machine virtuelle Java install&eacute;e. </p>
  <p>Si cela n&rsquo;est pas fais,<a href="http://www.eclipse.org/downloads/" target="_blank"> t&eacute;l&eacute;chargez ici Eclipse</a>, et ici le <a href="http://www.oracle.com/technetwork/java/javase/downloads/index.html" target="_blank">JDK Java (6+)</a>. </p>
    <p>&nbsp;</p>
    <p>Pour pouvoir utiliser GAL avec votre Eclipse, fa&icirc;tes comme suit : </p>
    <p>1) Lancez Eclipse
    </p>
  <p>2) Ouvrez le menu <strong>Help</strong> &rarr; <strong>Install new software</strong>...    </p>
    <p>3) Cliquez sur <strong>Add...</strong> </p>
    <p>4) Dans la deuxi&egrave;me zone de texte (<strong>Location</strong>), collez-y cette adresse:    </p>
    <p><strong>http://teamcity-systeme.lip6.fr/guestAuth/repository/download/bt108/.lastSuccessful/update-site</strong></p>
    <p>Puis validez. </p>
    <p>Vous verrez ensuite cette fen&ecirc;tre : </p>
  <p align="center"><img src="images/captures/Capture-Install .png" width="760" height="624" /></p>
    <p>Cochez &ldquo;<strong>GAL Xtext based feature</strong>&rdquo; et cliquez sur <strong>Next</strong>, puis encore sur <strong>Next</strong>.<br />
      Ensuite, cliquez sur &ldquo;<strong>I accept the terms of the license agreement</strong>&rdquo;, puis cliquez sur <strong>Finish</strong>.    </p>
    <p>Eclipse proc&egrave;dera au t&eacute;l&eacute;chargement du plugin sur votre ordinateur. Lorsque l&rsquo;installation sera termin&eacute;e, il vous sera demand&eacute; de red&eacute;marrer Eclipse. Acceptez, en cliquant sur <strong>restart</strong>.</p>
    <p>Apr&egrave;s cela, f&eacute;licitations, GAL est bien install&eacute; sur votre syst&egrave;me. </p>
    <p>&nbsp;</p>
</div>


<div class="story">
    <p>&nbsp;</p>
    <p><br />
    </p>
    <h2><a name="apercu"></a>3. Commencer avec GAL </h2>
    <p>&nbsp;</p>
    <p>Une fois  GAL install&eacute; sur votre Eclipse, vous pourrez cr&eacute;er un nouveau projet GAL en proc&eacute;dant ainsi: <br />
      File &rarr; New &rarr; Project &rarr; Xtext &rarr; Gal Project... 
    <p align="center"><img src="images/captures/new_gal_project.png" /></p>
</p>
    <p>Cliquez sur Next, puis entrez le nom de votre projet, et validez. </p>
    <p>Vous verrez ensuite un fichier pr&eacute;-rempli, <em>ExampleSystem.gal</em> , qui contient un exemple simple de code GAL. Ult&eacute;rieurement, dans le projet, il vous suffira de cr&eacute;er un fichier avec l&rsquo;extension .gal , et ainsi vous pourrez programmer en langage GAL.</p>
    <p>&nbsp;</p>
</div>
	
<div class="story">
	
    <p>
    <h3><a name="package-presentation"></a> 3.1. Pr&eacute;sentation des packages </h3>
  </p>
  <p>Dans un projet GAL, les fichiers sont structur&eacute;s de mani&egrave;re tr&egrave;s simple. Dans cet exemple ci-dessous, nous avons cr&eacute;&eacute; un projet nomm&eacute; <em>AGalProject</em> :  </p>
  <p align="center"><img src="images/captures/packages_1.png" />&nbsp;</p>
  <ul>
    <li><strong>src/</strong> contient les fichiers sources GAL : c'est l&agrave; que devrons se trouver tous les fichiers GAL que vous &eacute;crivez. </li>
    <li><strong> src-gen/</strong> contient les fichiers qui sont g&eacute;n&eacute;r&eacute;s automatiquement, &agrave; chaque sauvegarde d'un fichier GAL. Cette partie sera d&eacute;taill&eacute;e dans la section Ex&eacute;cution de programmes GAL </li>
  </ul>
</div>
	<div class="story">
	<p>
	<h3><a name="package-presentation"></a> 3.2 Aper&ccedil;u </h3>
    <p>Voici un petit exemple d&rsquo;un syst&egrave;me &eacute;crit en GAL </p>
    <?php 
		printGalFile("galfiles/sample-1.gal");
	?>


	
    <p>Ce code montre les &eacute;l&eacute;ments d&rsquo;un langage imp&eacute;ratif tels que les d&eacute;clarations de variables et autres affectations, et des subtilit&eacute;s propres aux descriptions des syst&egrave;mes concurrents. </p>
    <p>L&rsquo;accent a &eacute;t&eacute; mis pour d&eacute;finir un langage simple, mais permettant de d&eacute;finir ais&eacute;ment des syst&egrave;mes concurrents, ici formalis&eacute;s sous forme de &ldquo;transitions&rdquo;. Elles sont assimilables aux transitions des automates ou les r&eacute;seaux de Petri. </p>
    <p>Par la suite nous d&eacute;taillerons les m&eacute;canismes du langage et ensuite nous vous d&eacute;voilerons les d&eacute;tails d&rsquo;impl&eacute;mentation du langage.</p>
    <p></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>


<div class="story">
	<h2><a name="le-langage-gal"></a>4. Le langage GAL</h2>
	<p>Cette section d&eacute;crit le langage GAL et les s&eacute;mantiques des concepts qu&rsquo;il offre.</p>
</div>

<div class="story">
	<h3><a name="what-is-gal"></a>4.1 Qu'est ce que le GAL </h3>
	<p>Le GAL est l'acronyme de <strong>Guarded Action Language,</strong>          qui est un langage  de programmation d&eacute;di&eacute; &agrave; la v&eacute;rification formelle des syst&egrave;mes concurrents. </p>
</div>

<div class="story">
	<h3><a name="utilite-gal"></a>4.2 A quoi sert-il ? </h3>
	<p>&nbsp;</p>
	<p>Le GAL est un assembleur s&eacute;mantique adapt&eacute; &agrave; la v&eacute;rification formelle,  &agrave; l'aide de m&eacute;thodes symboliques ; c'est donc un DSL (Domain Specific Language),  qui permet de noter des automates avec un niveau d'abstraction &eacute;l&eacute;v&eacute; (manipulation des expressions enti&egrave;res, des entiers, etc...).</p>
	<p>Il est aussi utilis&eacute; pour la mod&eacute;lisation de syst&egrave;mes concurrents en vue de leur v&eacute;rification par model-checking, et peut servir pour la manipulation d'ensemble d'&eacute;tats &agrave; l'aide de diagrammes de d&eacute;cision  ([ddd.lip6.fr](http://ddd.lip6.fr)) </p>
	<p>&nbsp;</p>
</div>
<div class="story">
	<h3><a name="concepts-gal"></a>4.3 Concepts du GAL </h3>
</div>


<div class="story">	
	<h4><a name="fichiers-gal" ></a>4.3.1  Fichiers GAL</h4>
	<p>Les fichiers GAL sont des fichiers simples avec l&rsquo;extension gal. Par exemple <em>foo.gal</em> est un nom de fichier gal valide..</p>
</div>

<div class="story">
	<h4><a name="systeme-gal" ></a>4.3.2  Syst&egrave;me GAL</h4>
	
	
	<p>Un syst&egrave;me GAL est caract&eacute;ris&eacute; par un nom, et contient une suite d'instructions que nous d&eacute;taillerons au fil de ce document. </p>
	<p>Une fois un fichier GAL cr&eacute;&eacute; et ouvert, toutes les instructions (cf. les sections suivantes) du nouveau syst&egrave;me doivent &ecirc;tre plac&eacute;es dans un bloc structur&eacute;. On commence d'abord &agrave; &eacute;crire le mot-cl&eacute; <span class="galElement">GAL</span> (en majuscule), suivi obligatoirement du nom du syst&egrave;me. Ce nom doit commencer par une lettre de l'alphabet, et non par un chiffre ou autre symbole. Une bonne pratique est de donner des noms significatifs aux syst&egrave;mes cr&eacute;&eacute;s. </p>
	<p>Une fois le nom du syst&egrave;me &eacute;crit, on le fait suivre par un bloc (accolade ouvrante &ndash; accolade fermante), qui contiendra toutes les autres instructions que le langage GAL offre.  </p>
	<p>Voici en clair &agrave; quoi ressemble une d&eacute;claration d&rsquo;un syst&egrave;me GAL dont le nom est <em>foo</em>, et sauvegard&eacute; dans un fichier sous la d&eacute;nomination<em> foo.gal</em>:</p>
	<p>
	  <?php
		printGalFile("galfiles/sample-2.gal");
	?>
</p>
	<p>&nbsp;    </p>
</div>

<div class="story">	
	<h4><a name="declaration-variables" ></a>4.3.3  D&eacute;claration de variables</h4>
	
	
	
	
	<p>Un des concepts de base du GAL est la d&eacute;claration de variables. Les variables manipul&eacute;es en GAL sont de type entier, il n&rsquo;y pas d&rsquo;autres types tels qu&rsquo;ils sont pr&eacute;sent dans d&rsquo;autres langages g&eacute;n&eacute;raux comme le C ou JAVA.</p>
	<p>La section pr&eacute;c&eacute;dente a montr&eacute; comment introduire un nouveau syst&egrave;me; dans ce paragraphe, nous exposons la fa&ccedil;on dont les variables sont d&eacute;clar&eacute;es.<br />
	</p>
	<p>L&rsquo;introduction d&rsquo;une nouvelle variable en GAL se fait avec le mot clef <span class="galElement">int</span> suivi du nom de la variable commen&ccedil;ant par une lettre -- il faut que le nom soit unique, donc non assign&eacute; &agrave; une autre entit&eacute; du programme. On fait ensuite suivre ce nom par le signe =, puis d&rsquo;une valeur initiale (nombre entier) &agrave; cette variable. La d&eacute;claration se termine par un point-virgule.<br />
  </p>
    <p>En GAL toute variable d&eacute;clar&eacute;e doit &ecirc;tre initialis&eacute;e.</p>
    <p>&nbsp;</p>
    <p>Ci-dessous, un exemple d&rsquo;un syst&egrave;me GAL avec deux d&eacute;clarations de variable:</p>
	
	<?php
	printGalFile('galfiles/sample-3.gal');
	?>
   <p>&nbsp;
   </p> 
</div>
	

<div class="story">	
	<h4><a name="declaration-tableaux" ></a>4.3.4  D&eacute;claration de tableaux </h4><br />
	<p>Une autre forme de d&eacute;claration est celle des tableaux, ceux-ci permettent de d&eacute;clarer plusieurs variables en une instruction et offrent ainsi un acc&egrave;s index&eacute; aux variables. Comme pour une variable simple, l&rsquo;initialisation de chacune des cases du tableau est obligatoire.<br />
	</p>
	
    <p>On proc&egrave;de ainsi&nbsp;: on &eacute;crit le mot clef <span class="galElement">array</span> suivi de la taille entre crochets, puis du nom du tableau, et du signe =, puis d&rsquo;une liste de valeurs s&eacute;par&eacute;es avec des virgules, et entour&eacute;es avec des parenth&egrave;ses en terminant l&rsquo;instruction avec ; (point-virgule).</p>
    <p>Un exemple d&rsquo;un syst&egrave;me avec une d&eacute;claration d&rsquo;un tableau:
    </p>
	<?php
	printGalFile('galfiles/sample-4.gal');
	
	?>
	<p>&nbsp;</p>
</div>

<div class="story">	
	<h4><a name="declaration-listes" ></a>4.3.5  D&eacute;claration de listes </h4><br />
	<p>Les listes offrent une structure bas&eacute;e sur le principe de LIFO (Last In, First Out). Contrairement aux variables et aux tableaux, l&rsquo;initialisation des listes n&rsquo;est pas obligatoire, toutefois on peut leur donner des valeurs initiales. L&rsquo;acc&egrave;s aux valeurs sauvegard&eacute;es dans les listes se fait par empilement et d&eacute;pilement du sommet de la pile (cf. actions sur les listes)<br />
	</p>
    <p>La d&eacute;claration d&rsquo;une liste se fait avec le mot clef <span class="galElement">list</span> suivi du nom de la liste et &eacute;ventuellement, suivi d&rsquo;un signe = puis une liste de valeurs comprises entre deux parenth&egrave;ses, et les valeurs s&eacute;par&eacute;es par des virgules. Comme les autres d&eacute;clarations, l&rsquo;instruction se termine avec un point-virgule.</p>
    <p>Ci-dessous un exemple d&rsquo;un syst&egrave;me d&eacute;clarant deux listes, une initialis&eacute;e, l&rsquo;autre non:<br />
    </p>
	<?php
		printGalFile('galfiles/sample-5.gal');
	?>
	<p>&nbsp;</p>
</div>	
	

<div class="story">
	<h4><a name="transition" ></a>4.3.6 Transition  </h4><br />
	<p>Ce bloc permet de passer d&rsquo;un &eacute;tat &agrave; un autre &eacute;tat, en fonction d&rsquo;une garde, celle-ci &eacute;tant  une expression bool&eacute;enne. En fonction de sa valeur, on change d&rsquo;&eacute;tat, en ex&eacute;cutant des instructions (cf. actions) &eacute;crites dans le corps de la transition.<br />
	</p>
    <p>On &eacute;crit une transition avec le mot-cl&eacute; <span class="galElement">transition</span>, suivi d&rsquo;un nom commen&ccedil;ant par une lettre, puis d&rsquo;une garde (expression bool&eacute;enne) entre crochet. On peut &eacute;ventuellement la faire suivre d&rsquo;un libell&eacute; gr&acirc;ce au mot-cl&eacute; <span class="galElement">label</span>. Ensuite, on &eacute;crit dans un bloc d&rsquo;accolades, le corps de cette transition.</p>
    <p>Un exemple avec deux transitions d&rsquo;un syst&egrave;me, la premi&egrave;re avec un label:<br />
    </p>
	<?php
		printGalFile('galfiles/sample-6.gal');
	?>
</div>	

<div class="story">
	<h4><a name="action" ></a>4.3.7 Actions </h4>
	<p>Les actions sont des op&eacute;rations appliqu&eacute;es sur les variables du syst&egrave;me, consistant exclusivement &agrave; des affectations (sur des variables ou &eacute;l&eacute;ments de tableaux), ou des actions (retrait ou ajout) sur des listes : <span class="galElement">pop()</span> et <span class="galElement">push()</span> (cf. paragraphe Actions).</p>

</div>

<div class="story">	
	<h5><a name="op-arith"></a> a) Op&eacute;rations arithm&eacute;tiques</h5>
	
	<p align="center">
		<strong>Binaires</strong>	
	</p>
	<table width="200" border="1" align="center" style="border-collapse:collapse">
      <tr>
        <th scope="col">Op&eacute;ration</th>
        <th scope="col">Op&eacute;rateur</th>
      </tr>
      <tr align="center">
        <td >OR bit &agrave; bit </td>
        <td>|</td>
      </tr>
      <tr align="center">
        <td>XOR bit &agrave; bit </td>
        <td>^</td>
      </tr>
      <tr align="center">
        <td>AND bit &agrave; bit </td>
        <td>&amp;</td>
      </tr>
      <tr align="center">
        <td>Shift gauche </td>
        <td>&lt;&lt;</td>
      </tr>
      <tr align="center">
        <td>Shift droit </td>
        <td>&gt;&gt;</td>
      </tr>
      <tr align="center">
        <td>Addition</td>
        <td>+</td>
      </tr>
      <tr align="center">
        <td>Soustraction</td>
        <td>-</td>
      </tr>
      <tr align="center">
        <td>Multiplication</td>
        <td>*</td>
      </tr>
      <tr align="center">
        <td>Modulo</td>
        <td>%</td>
      </tr>
      <tr align="center">
        <td>Division</td>
        <td>/</td>
      </tr>
	  <tr align="center">
        <td>Puissance</td>
        <td>**</td>
      </tr>
    </table>
	<p>	</p>
	
	
	
	<p align="center">
		<strong>Unaires</strong>	
	</p>
	<table width="200" border="1" align="center" style="border-collapse:collapse">
      <tr>
        <th scope="col">Op&eacute;ration</th>
        <th scope="col">Op&eacute;rateur</th>
      </tr>
      <tr align="center">
        <td >Le moins unaire </td>
        <td>-</td>
      </tr>
      <tr align="center">
        <td>Compl&eacute;ment bit &agrave; bit </td>
        <td>~</td>
      </tr>
    </table>
	<p>	</p>
</div>


<div class="story">
	<h5><a name="expr-bool"></a>b) Expressions bool&eacute;ennes</h5>
	<p>Les expressions bool&eacute;ennes sont permises dans les gardes des transitions. Il est aussi possible d&rsquo;&eacute;crire des expressions arithm&eacute;tiques, &agrave; l&rsquo;apparence bool&eacute;enne (comme en C), qui vaudront 1 ou 0 selon qu&rsquo;elles sont vraies ou fausses (cf. Wrapper)<br />
	</p>
    <p>Les expressions basiques sont <span class="galElement">True</span> pour &laquo;&nbsp;vrai&nbsp;&raquo; et <span class="galElement">False</span> pour &laquo;&nbsp;faux&nbsp;&raquo;. Les op&eacute;rateurs bool&eacute;ens usuels sont pr&eacute;sents dans le GAL, en l&rsquo;occurrence OR ( || ), AND ( &amp;&amp; ) et NOT( ! ). <br />
    </p>
    <p>Un autre cas de ces expression est la comparison, celle-ci prends deux expressions enti&egrave;res et les compare avec les op&eacute;rateurs de comparaison qui sont:</p>
    <table width="200" border="1" style="border-collapse:collapse" align="center">
      <tr align="center">
        <th scope="col">Op&eacute;ration</th>
        <th scope="col">Op&eacute;rateur</th>
      </tr>
      <tr align="center">
        <td>Strictement sup&eacute;rieur </td>
        <td>&gt;</td>
      </tr>
      <tr align="center">
        <td>Strictement inf&eacute;rieur </td>
        <td>&lt;</td>
      </tr>
      <tr align="center">
        <td>Sup&eacute;rieur ou &eacute;gal </td>
        <td>&gt;=</td>
      </tr>
      <tr align="center">
        <td>Inf&eacute;rieur ou &eacute;gal </td>
        <td>&lt;=</td>
      </tr>
      <tr align="center">
        <td>Egalit&eacute;</td>
        <td>==</td>
      </tr>
      <tr align="center">
        <td>Non-&eacute;galit&eacute;</td>
        <td>!=</td>
      </tr>
    </table>
    <p>&nbsp;</p>
</div>


<div class="story">
	<h5><a name="wrapper"></a>  c) Wrapper (enveloppeur) des expressions bool&eacute;ennes </h5>
	<p> <br />
	</p>
    <p>M&eacute;langer les expressions arithm&eacute;tiques et les expressions bool&eacute;ennes dans une m&ecirc;me expression arithm&eacute;tique est possible en GAL, en entourant l&rsquo;expression bool&eacute;enne avec des parenth&egrave;ses, ceci permettant de voir l&rsquo;expression bool&eacute;enne comme valant 0 en cas o&ugrave; son &eacute;valuation vaut faux, sinon 1. Cette technique nous permet d&rsquo;obtenir une partie de la puissance des expressions du langage C et avoir une expressivit&eacute; assez similaire.</p>
    <p>
	<code>Exemple&nbsp;: maVariable = (a == 0) * 100&nbsp;;<i>//maVariable vaut 100 ou 0</i></code> </p>
    <p><br />
    </p>
</div>

<div class="story">
	<h5><a name="op-listes"></a>d) Op&eacute;rations sur les listes </h5>
	<p>Comme dit pr&eacute;c&eacute;demment, les listes sont bas&eacute;es sur le principe LIFO, donc GAL fournit des op&eacute;rations de manipulation de cette structure. Voici les op&eacute;rations appliqu&eacute;es sur les listes:<br />
	</p>
	
    <p><span class="galElement">push</span>(<em> liste</em>, <em>expression enti&egrave;re</em>): permet d&rsquo;empiler une valeur enti&egrave;re sur la liste.</p>

    <p><span class="galElement">peek(</span><em>liste</em><span class="galElement">)</span>: renvoie le sommet de la pile sans l&rsquo;extraire. Il faut aussi faire attention &agrave; ce qu&rsquo;&agrave; l&rsquo;invocation de cette op&eacute;ration, la liste ne soit pas vide.</p>
    <p><span class="galElement">pop(</span><em>liste</em><span class="galElement">)</span>: idem que <code>peek(liste)</code>, seulement cette op&eacute;ration extrait le sommet de la pile sans le renvoyer.</p>
    <p>Ci-dessous un exemple d&rsquo;un syst&egrave;me qui offre un petit panorama de la majorit&eacute; des concepts li&eacute;s au GAL:<br />
    </p>
    <p>
      <?php
		printGalFile('galfiles/sample-7.gal');
	?>
</p>
    <p>&nbsp;    </p>
</div>	


<div class="story">	
	<h4><a name="transient" ></a>4.3.8  Transient</h4>
	<p><br />
	</p>
    <p><span class="galElement">TRANSIENT</span> est un mot-cl&eacute; qui, en lui affectant une expression bool&eacute;enne, permet (en fonction de sa valeur) d&rsquo;examiner les n&oelig;uds (transitions) ou les ignorer.</p>

    <p>Une telle expression est d&eacute;clar&eacute;e avec le mot-cl&eacute; <span class="galElement">TRANSIENT</span>, suivi du signe d&rsquo;affectation =, puis d&rsquo;une expression bool&eacute;enne.</p>

    <p>Voici un syst&egrave;me qui r&eacute;sume toutes les fonctionnalit&eacute;s du GAL:<br />
    </p>
    <p>
      <?php
	printGalFile('galfiles/sample-8.gal');
	?>
</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;    </p>
</div>

<div class="story">	
	<h3><a name="fonctionnalites-editeur" ></a>4.4  Fonctionnalit&eacute;s de l'&eacute;diteur GAL</h3>
	<p>
	Le plugin Eclipse GAL h�rite des fonctionnalit�s d'�dition de l'IDE Eclipse et ceci facilite l'�criture des syst�mes concurrents.	</p>
	<p><img src="images/captures/1_.png"  /></p>
</div>


<div class="story">	
	<h4><a name="autocompletion" ></a>4.4.1  Auto-compl�tion</h4>
	<p>L&rsquo;une des fonctionnalit&eacute;s d&rsquo;Eclipse les plus connues est l'auto-compl&eacute;tion, en appuyant simultan&eacute;ment sur<em> CTRL + ESPACE</em>, le GAL propose une liste d'&eacute;l&eacute;ments susceptibles de compl&eacute;ter le mot en fonction des caract&egrave;res d&eacute;j&agrave; &eacute;crits, ou sinon les &eacute;l&eacute;ments qui peuvent &ecirc;tre plac&eacute;s &agrave; l&rsquo;endroit o&ugrave; le curseur est plac&eacute;.</p>
	<p> Voici un exemple d&rsquo;auto-compl&eacute;tion propos&eacute;:<br />
    </p>
	<p>&nbsp;</p>
    <p align="center">
  <img src="images/captures/autocomplete-1.png" /></p>
    <p></p>
    <p></p>
</div>

<div class="story">
	<h2><a name="execution-gal"></a>5. Ex&eacute;cution de programmes GAL</h2>
	<p>&nbsp;</p>
	<p>Comme dans tout langage imp&eacute;ratif,  GAL est livr&eacute; avec la possibilit&eacute; d'ex&eacute;cuter, de mani&egrave;re indirecte, tout programme GAL que vous aurez &eacute;crit. Il vous est aussi possible de d&eacute;boguer votre programme, en positionnant par exemple des points d'arr&ecirc;t (breakpoints) directement dans l'&eacute;diteur GAL, et en suivant pas &agrave; pas, les transitions qui seront franchies, et l'&eacute;tat des variables du programme. </p>
	<p>&nbsp;</p>
</div>


<div class="story">
	<h3><a name="execution"></a>5.1 Ex&eacute;cution simple dans l'Editeur </h3>
	<p>&nbsp;</p>
	<p>Comme mentionn&eacute; plus haut, les fichiers sources GAL doivent &ecirc;tre positionn&eacute;s dans le dossier src de votre projet. Par exemple dans l'image ci-dessous, nous avons cr&eacute;&eacute; un programme MyFirstGAL.gal</p>
	<p align="center"><img src="images/captures/galproject.png" /></p>
	<p>&nbsp;</p>
	<p>Lorsque le programme est correctement sauvegard&eacute;, des fichiers sources Java sont automatiquement g&eacute;n&eacute;r&eacute;s, pour vous permettre de pouvoir ex&eacute;cuter le programme GAL qui a &eacute;t&eacute; &eacute;crit. Pour cela, dans le dossier src-gen/ , il existe au moins trois packages : </p>
	<ul>
	  <li>gal : contient le fichier Java &eacute;quivalent &agrave; votre programme GAL</li>
      <li>main : contient le fichier Java qui ex&eacute;cutera la version Java de votre programme. Il existe plusieurs strat&eacute;gies d'ex&eacute;cution de programme, que nous verrons dans les sections ci-dessous.</li>
      <li>transitions.<em>NomDeVotreFichierGal</em> : contient les classes Java repr&eacute;sentant les transitions &eacute;crites dans votre fichier GAL.</li>
  </ul>
	<p>&nbsp;</p>
	<p>Pour &quot;ex&eacute;cuter&quot; votre programme GAL, lancez le fichier <em>NomDeVotreFichierGal</em>_Main.java qui est dans le package main. </p>
	<p>&nbsp;</p>
	<p><strong><em>Strat&eacute;gies d'ex&eacute;cution du programme : </em></strong></p>
	<p>L'ex&eacute;cution d'un programme GAL part d'un &eacute;tat initial, puis tente de franchir des transitions, selon que leurs gardes soient vraies ou non. Pour un &eacute;tat donn&eacute;, il peut avoir plusieurs transitions qui sont franchissables. Quelle transition alors choisir ? C'est pourquoi il existe plusieurs modes d'ex&eacute;cution de programmes GAL, afin que l'utilisateur puisse choisir le comportement &agrave; adopter quand il s'agira de la s&eacute;lection de transition franchissables.  </p>
	<p>Il existe plusieurs mani&egrave;res (trois au total) d'ex&eacute;cuter un programme GAL : </p>
	<ul>
	  <li><strong>Le mode al&eacute;atoire</strong> : dans ce mode, le programme qui s'ex&eacute;cute choisit de franchir al&eacute;atoirement une transition,<strong> parmi </strong>toutes celles qui sont franchissables. Pour activer ce mode, il suffit de passer sur la ligne de commande du programme main ( <em>NomDeVotreFichierGal</em>_Main.java ), l'option <code class="launchmode">--random</code><br />
	  &nbsp;</li>
      <li><strong>Le mode interactif</strong> : mode dans lequel, le programme interagit avec l'utilisateur, en lui laissant la possibilit&eacute; de choisir (au clavier) une transition parmi toutes celles qui sont franchissables, jusqu'&agrave; ce qu'il n' y ait plus de transitions franchissables. <br />
        Ce mode s'active avec l'option <code class="launchmode">--keyboard </code><br />
      &nbsp;</li>
      <li><strong>Le mode trace </strong>: dans ce mode, on sp&eacute;cifie au programme, une trace de transitions (sens&eacute;es &ecirc;tre franchissables) qu'il se doit de suivre. Le fichier de trace est un simple fichier texte, contenant un num&eacute;ro de transition par ligne. Les num&eacute;ros sont de transitions sont normalement ordonn&eacute;s selon leur apparition dans le fichier GAL, et commencent &agrave; 0. Par exemple si un fichier GAL contient, dans l'ordre, les transitions t1, t2, t3, alors t1 aura pour num&eacute;ro 0, t2 le num&eacute;ro 1, t3 le num&eacute;ro 2.<br />
        Ce mode s'active avec l'option <code class="launchmode">--trace <em>fichierDeTrace</em></code> <br />
      &nbsp;</li>
      <li><strong>Le mode sauvegarde </strong>: N'&eacute;tant pas vraiment un mode d'ex&eacute;cution, et &eacute;tant optionnel, il permet de sp&eacute;cifier au programme un nom de fichier dans lequel enregistrer la trace d'ex&eacute;cution parcourue. <br />
      On le sp&eacute;cifie avec l'option <code class="launchmode">--store <em>fichierDeSortieDeTrace</em></code></li>
  </ul>
	<p>&nbsp;</p>
	<p>Pour passer des arguments au programme dans Eclipse,  faites clic-droit sur le fichier <em>votreFichierGal</em>_Main.java du package <strong>main</strong>, puis faites Run As --&gt; Run configurations...</p>
	<p>Dans l'onglet Arguments, remplissez dans la case &quot;Program arguments&quot; , les arguments que vous voudriez rajouter sur la ligne de commande du programme GAL ( l'une des options vues ci-dessus) </p>
	<p>&nbsp;</p>
	<p align="center"><img src="images/captures/Arguments-RunConfigurations.png" /></p>
	<p align="center">&nbsp;</p>
	<p align="center">&nbsp;</p>
</div>

<div class="story">
	<h3><a name="debug-gal"></a>5.2 D&eacute;bogage dans GAL </h3>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>Une des fonctionnalit&eacute;s int&eacute;ressantes du plugin est la possibilit&eacute; de pouvoir d&eacute;boguer le code GAL, lors de son ex&eacute;cution. Ainsi, il devient possible de voir pas &agrave; pas quelle transition est franchie, laquelle ne l'est pas, etc... </p>
	<p>Voici un aper&ccedil;u du d&eacute;bogage GAL </p>
	<p align="center"><img src="images/captures/debugMyFirstGAL.png" /></p>
	<p>&nbsp;</p>
	<p>Pour lancer le d&eacute;bogage d'un programme GAL, fa&icirc;tes comme suit : </p>
	<p>- Faites clic-droit sur le fichier <em>votreFichierGal</em>_Main.java du package <strong>main</strong>, puis faites Debug As --&gt; Java Application<br />
    - Vous pouvez optionnellement (mais recommand&eacute;) vous rendre dans la vue Debug (menu Window --&gt; Open perspective --&gt; Debug (ou Other --&gt; Debug ) </p>
	<p>Il vous est aussi possible de sp&eacute;cifier des arguments au programme (qui sont les options vues ci-dessus). Pour cela,  faites clic-droit sur le fichier <em>votreFichierGal</em>_Main.java du package <strong>main</strong>, puis faites Debug As --&gt; Debug configuration , puis les rajouter dans l'onglet Arguments.</p>
	<p>&nbsp; </p>
	<p>&nbsp;</p>
</div>



<div class="story">
	<h3><a name="api-gal"></a>5.3 API de GAL </h3>
	<p>&nbsp;</p>
  <p>Par d&eacute;faut dans GAL, le programme main et plusieurs autres fichiers (classes des transitions, classe Java r&eacute;pr&eacute;sentant le syst&egrave;me GAL) sont automatiquement g&eacute;n&eacute;r&eacute;s &agrave; chaque sauvegarde de fichier .gal, et sont situ&eacute;s dans <strong>src-gen/</strong>. <br />
  Mais il est aussi possible de cr&eacute;er vos propres fichiers Java, pour manipuler le syst&egrave;me. Ainsi, il vous sera possible de personnaliser l'ex&eacute;cution de GAL &agrave; votre go&ucirc;t, en cr&eacute;ant par exemple votre propre fichier main. </p>
	<p>Toutefois, gardez bien &agrave; l'esprit que pour pouvoir manipuler un syst&egrave;me GAL, vous devez imp&eacute;rativement avoir  une instance de ce syst&egrave;me. Exemple : </p>
	<pre><code>
	IGAL mySystem = <span class="galElement">new</span> <em>Nom_de_votre_systeme_GAL</em>() ; 
	</code></pre>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p class="galInterfaceTitle">IGAL </p>
	<p>IGAL est l'interface qui d&eacute;crit un syst&egrave;me GAL, et tout ce qu'il contient. Lorsque vous &eacute;crivez un fichier GAL, par d&eacute;faut un fichier Java impl&eacute;mentant cette interface est automatiquement g&eacute;n&eacute;r&eacute;, dans src-gen/gal/<em style="color:#990000">VotreSystemeGAL</em>.java </p>
	<p><strong>M&eacute;thodes de IGAL </strong></p>
	
	
	<table width="688" border="1"  style="border-collapse:collapse;" >
      <tr valign="top" >
        <th width="108" scope="col">Valeur de retour </th>
        <th width="564" scope="col">Nom de la m&eacute;thode </th>
      </tr>
      <tr valign="top">
        <td valign="top" ><code>String</code></td>
        <td valign="top"><code>getName()</code><br /><br />
        <span class="codeDescription">Retourne le nom du syst&egrave;me GAL </span></td>
      </tr>
      <tr>
        <td valign="top"><code>[IState](#desc-istate)</code></td>
        <td valign="top"><code>getInitState()</code> <br />
        <br />
		<span class="codeDescription"> Retourne l'&eacute;tat initial du syst&egrave;me. L'&eacute;tat initial contient toutes les variables (entiers, tableaux, listes) et les valeurs auquelles ils ont &eacute;t&eacute; associ&eacute;s &agrave; l'initialisation.</span></td>
      </tr>
      <tr>
        <td valign="top"><code>List&lt;[ITransition](#desc-itransition)&gt;</code></td>
        <td valign="top"><code>getTransitions() </code><br />
        <br />
		<span class="codeDescription">Retourne la liste de toutes les transitions du syst�me GAL</span>
		</td>
      </tr>
	  
	   <tr>
        <td valign="top"><code>boolean</code></td>
        <td valign="top"><code>getTransient([IState](#desc-istate) entryState) </code><br />
        <br />
		<span class="codeDescription">Retourne la valeur bool&eacute;enne de l'instruction TRANSIENT. <code>entryState</code> est l'&eacute;tat dans lequel seront consult&eacute;es les valeurs des variables. </span>
		</td>
      </tr>
    </table>
	<p>&nbsp;</p>
	<p class="galInterfaceTitle"><a name="desc-itransition"></a>ITransition</p>
	<p>Cette interface r&eacute;pr&eacute;sente une transition dans un syst&egrave;me GAL.</p>
	<p><strong>M&eacute;thodes de ITransition </strong></p>
	<table width="688" border="1"  style="border-collapse:collapse;" >
      <tr valign="top" >
        <th width="108" scope="col">Valeur de retour </th>
        <th width="564" scope="col">Nom de la m&eacute;thode </th>
      </tr>
      <tr valign="top">
        <td valign="top" ><code>String</code></td>
        <td valign="top"><code>getName()</code><br />
            <br />
            <span class="codeDescription">Retourne le nom de la transition </span></td>
      </tr>
      <tr>
        <td valign="top"><code>boolean</code></td>
        <td valign="top"><code>guard([IState](#desc-istate) entryState)</code> <br />
            <br />
        <span class="codeDescription"> Retourne la valeur bool&eacute;enne de la garde de la transition. <code>entryState</code> est l'&eacute;tat dans lequel seront consult&eacute;es les valeurs des variables. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>IState</code></td>
        <td valign="top"><code>successor([IState](#desc-istate) entryState) </code><br />
            <br />
        <span class="codeDescription">Evalue le corps de la transition, et retourne un &eacute;tat dans lequel les variables ont &eacute;t&eacute; modifi&eacute;es. <code>entryState</code> est l'&eacute;tat dans lequel seront consult&eacute;es les valeurs des variables. </span> </td>
      </tr>
      
    </table>
	<p>&nbsp;</p>
	<p class="galInterfaceTitle"><a name="desc-istate"></a>IState</p>
	<p>Cette interface r&eacute;pr&eacute;sente un &quot;&eacute;tat&quot; dans un syst&egrave;me GAL. Un &eacute;tat peut &ecirc;tre assimil&eacute; &agrave; un grand ensemble, qui contient des listes, tableaux, et variables, et les valeurs auxquels ils sont associ&eacute;s &agrave; un moment pr&eacute;cis. </p>
	<p><strong>M&eacute;thodes de IState </strong></p>
	<table width="688" border="1"  style="border-collapse:collapse;" >
      <tr valign="top" >
        <th width="108" scope="col">Valeur de retour </th>
        <th width="564" scope="col">Nom de la m&eacute;thode </th>
      </tr>
      <tr valign="top">
        <td valign="top" ><code>int</code></td>
        <td valign="top"><code>getNumberOfVariables()</code><br />
            <br />
            <span class="codeDescription">Retourne le nombre de variables du syst&egrave;me. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>int</code></td>
        <td valign="top"><code>getNumberOfArrays() </code> <br />
            <br />
            <span class="codeDescription"> Retourne le nombre de tableaux dans le syst&egrave;me. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>int</code></td>
        <td valign="top"><code>getNumberOfLists() </code><br />
          <br />
        <span class="codeDescription">Retourne le nombre de listes du syst&egrave;me</span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>addVariable(String varName, Integer value) </code><br />
          <br />
			<span class="codeDescription">Ajoute une variable dans l'&eacute;tat.</span>
        </td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>createArray(String arrayName, List&lt;Integer&gt;initValues)</code><br />
          <br />
          <span class="codeDescription">Cr&eacute;e un tableau, initialis&eacute; avec chaque &eacute;l&eacute;ment de la liste des entiers </span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>setValueInArray(String arrayName, int indexOfValue, Integer value)<br />
          <br />
</code>
        <span class="codeDescription">Attribue une valeur &agrave; l'&eacute;l&eacute;ment &agrave; la position <em>indexOfValue</em> du tableau <em>arrayName</em></span></td>
      </tr>
      <tr>
        <td valign="top"><code>Integer</code></td>
        <td valign="top"><code>getValueInArray(String arrayName, int indexOfValue)<br />
          <br />
</code>
          <span class="codeDescription">Retourne la valeur de l'&eacute;l&eacute;ment &agrave; la position <em>indexOfValue</em>, du tableau <em>arrayName</em> </span></td>
      </tr>
      <tr>
        <td valign="top"><code>int</code></td>
        <td valign="top"><code>getSizeOfArray(String arrayName)<br />
          <br />
</code>
        <span class="codeDescription">Retourne la taille du tableau <em>arrayName</em> </span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>createList(String listName, List&lt;Integer&gt; initValues)<br />
          <br />
</code>
        <span class="codeDescription">Cr&eacute;e une liste initialis&eacute;e avec les valeurs de la liste. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>popInList(String listName)<br />
          <br />
        </code>
        <span class="codeDescription">Retire le premier &eacute;l&eacute;ment de la liste <em>listName</em> </span></td>
      </tr>
      <tr>
        <td valign="top"><code>Integer</code></td>
        <td valign="top"><code>peekInList(String listName) </code> <br />
          <br />
        <span class="codeDescription">Renvoie le premier &eacute;l&eacute;ment de la liste, sans le renvoyer. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>pushInList(String listName, Integer valueToPush)<br />
          <br />
</code>
          <span class="codeDescription">Rajoute &agrave; la liste listName, l'entier <em>valueToPush</em> </span></td>
      </tr>
      <tr>
        <td valign="top"><code>Integer</code></td>
        <td valign="top"><code>getValueInList(String listName, int indexOfValue)<br />
          <br />
</code>
        <span class="codeDescription">Renvoie la valeur &agrave; la position <em>indexOfValue</em> dans la liste </span></td>
      </tr>
      <tr>
        <td valign="top"><code>int </code></td>
        <td valign="top"><code>getSizeOfList(String listName)<br />
          <br />
</code>
        <span class="codeDescription">Renvoie la taille de la liste </span></td>
      </tr>
      <tr>
        <td valign="top"><code>Object</code></td>
        <td valign="top"><code>clone()</code><br />
          <br />
        <span class="codeDescription">Clone la liste. </span></td>
      </tr>
    </table>
	<p>&nbsp; </p>
</div>


