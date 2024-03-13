<?php
namespace App\Helpers;
/**   
 * Sn name generator
 * The names and first names used in this file,
 * comes from http://www.planete-senegal.com/senegal/noms_et_prenoms.php
 * 
 * PHP version 5
 * 
 * @category Utility
 * 
 * @package SN
 * 
 * @author Mouhamed Fadel Diagana <mouhamedfd>
 *
 * @license GPL 3.
 * 
 * @link http://github.com/mouhamedfd
 */
//namespace Dmf\Generator;
/**   
 * Class That generate Random Senegalese Name and FirstName
 * 
 * @category Utility
 * 
 * @package Dmf
 * 
 * @author Mouhamed Fadel Diagana <mouhamedfd@gmail.com>
 *
 * @license GPL 3.
 * 
 * @link http://github.com/mouhamedfd
 */

 
class SnNameGenerator
{

    public static $direction = array(

        "Direction Général",
        "Direction de l'Evaluation et de la Certification",
        "Direction de la planification des projets",
        "Direction Administrative et Financiere",
        "Direction de l'Ingenierie et des Operations de Formation",
    );

    public static $situationeconomique = array(

        "Très faible",
        "Faible",
        "Moyenne",
        "Correcte",
    );

    public static $sigledirection = array(

        "DG",
        "DEC",
        "DPP",
        "DAF",
        "DIOF",
    );

    public static $civilite = array(

        "M.",
        "Mme",
    );

    public static $typesstructure = array(
        "Publique",
        "Privée",
    );

    public static $handicap = array(
        "Oui",
        "Non",
    );

    public static $travailrenumeration = array(
        "Oui",
        "Non",
    );

    public static $victime_social = array(
        "Emigration irrégulière",
        "Déplacé ou démobilisé par le conflit",
        "Emprisonnement",
        "Aucun",
        "Autre",
    );

    public static $statut = array(

        "GIE",
        "Association",
        "Entreprise",
        "Institut publique",
        "Institut privée",
        "Amicale Etudiants/Elèves",
    );

    public static $situation = array(
        "Agriculteur exploitant",
        "Salarié de l’agriculture",
        "Industriel, artisan ou commerçant",
        "Profession libérale",
        "Cadre moyen ou supérieur",
        "Employé",
        "Ouvrier",
        "Personnel de services",
        "Retraité(e)",
        "Sans activité professionnelle",
        "En recherche d'emploi",
        "Etudiant",
        "Élève",       

    );

    public static $niveaux = array(
        "Primaire",
        "Collège",
        "Secondaire",
        "Supérieur",

    );

    public static $sexe = array(

        "M",
        "F",
    );
    public static $etablissement = array(

        "UCAD (université Cheikh Anta Diop) - Dakar",
        "UGB (université Gaston Berger) - Saint-Louis",
        "UDZ (université de Ziguinchor) - Ziguinchor",
        "UT (université de Thiès) - Thiès",
        "UB-CUR (université de Bambey) - Bambey",
        "UVS (université Virtuelle du Sénégal)",
        "ESP et UCAD - École supérieure polytechnique de Dakar et École polytechnique de Thiès",
        "ENA - haute fonction publique - Dakar",
        "ENSETP - École normale supérieure d'enseignement technique et professionnel",
        "ENDSS - médecine (formation technique et professionnelle) - Dakar",
        "ENS (UCAD) - enseignement - Dakar",
        "INSEPS (UCAD) - enseignement du sport - Dakar",
        "IUPA (UCAD) - pêche et aquaculture - Dakar",
        "DIT - Dakar Institute of Technology - Informatique - Dakar",
        "ESMT (École supérieure multinationale des télécommunications)",
        "CESAG - Centre africain d'études supérieures en gestion - Dakar",
        "EIA - École internationale des affaires Depuis 1998, formation en management avec diverses spécialités",
        "ENCR - (École nationale des Cadres ruraux) agriculture et élevage - Bambey",
        "ENSA - agronomie - Thiès",
        "ENTSS - (École nationale des travailleurs sociaux spécialisés) - Dakar",
        "ENEA - statistiques/ planification/ gestion urbaine - Dakar",
        "EBAD (UCAD) - École de bibliothécaires archivistes et documentalistes - Dakar",
        "CESTI (UCAD) - journalisme/ communication - Dakar",
        "ILEA (UCAD) - Langues étrangères appliquées au Tourisme et aux Affaires - Dakar",
        "ESMT - École supérieure multinationale des télécommunications - Dakar",
        "ESG Dakar - École supérieure de gestion - Dakar - commerce et management",
        "IST (UCAD) - formation d’ingénieurs géologues - Dakar",
        "ISE (UCAD) - environnement - Dakar",
        "ISED (UCAD) - santé et développement - Dakar",
        "IPDSR (UCAD) - population / développement / santé de la reproduction -Dakar",
        "ISG (UCAD) - finance/ comptabilité/ gestion - Dakar",
        "IAM - (Institut africain de management)",
        "ISI - (Institut supérieur d'informatique)",
        "ISM - (Institut supérieur de management)",
        "Groupe Supdeco Dakar (École supérieure de commerce de Dakar)",
        "AFI-L'UE - (L'université de l'Entreprise) - Dakar",
        "ESTM (École supérieure de technologie et de management)",
        "UEA (université Euro - Afrique), en partenariat avec l'université Jules Verne de Picardie - Dakar",
        "Collège Saint Michel",
        "ESTHOS-IMED",
        "Institut Privé de Gestion IPG",
        "SUN Hi-Tech3 Africa",
        "Académie Internationale de Coiffure et d’Esthétique (EXOCOIF)",
        "Alliance Générale des Informaticiens Formateurs (AGIF Informatique",
        "AND BOOLO XAMLE (ABX)",
        "Association des Retraités du Matériel des Armées ARMATA",
        "ATELIER DES DELICES",
        "CALEBASSE DOREE",
        "Centre d’Accompagnement et de Mise à Niveau (CAMAN)",
        "CENTRE D'APPUI A L'INITIATIVE FEMINIE  (CAIF)",
        "CENTRE DE TECHNOLOGIE ET  d'INGENIERIE/ECOLE DES SCIENCES DU COMMERCE ET DE  l'INFORMATION (CTI/ESCI)",
        "Centre européenne de formation en énergie renouvelable (CEFER)",
        "CENTRE POLYVALENT DE FORMATION PROFESSIONNELLE EN HOTELLERIE RESTAURATION ET TOURISME (CPFP/HR)",
        "Institut Santé Service ISS",
        "COLLECTIF SENEGALAIS POUR LA FORMATION (COSEFOR)",
        "COMPLEXE EVA",
        "CTA SAINT-MONT FORT ",
        "CUIM",
        "DOT HOME INSTITUT",
        "Ecole des Hautes Etudes de Gestion (EHG)",
        "Ecole Privée Maritime (EPRIM)",
        "ECOLE SUPERIEUR DES TECHNIQUES DE GESTION ESTG",
        "ECOLE SUPERIEUR INTERNATIONALE DE TOURISME ET D'HOTELLERIE / ESITH",
        "Ecole Supérieure d’Electricité, de Bâtiment et des Travaux Publics (ESEBAT)",
        "Ecole Supérieure d’Informatique Appliquée ESIA",
        "Ecole Supérieure de  Commerce et de  Gestion ESUP",
        "ECOLE SUPERIEURE DE GENIES ESGE",
        "Ecole supérieure de management stratégique (ESMS)",
        "ECOLE SUPERIEURE DES NOUVELLES TECHNOLOGIES (ESNT)",
        "FINAMA BUSINESS SCHOOL",
        "HAUTE ECOLE DE MANAGEMENT ET DE L'INFORMATIQUE HEMI",
        "HECM Hautes Etudes de Coaching et de Management",
        "HEPO",
        "IFMA",
        "Institut  de Formation en Assurances  et Gestion des Entreprises IFAGE",
        "Institut  de Management et de Technologie IMTECH",
        "INSTITUT CESAR",
        "Institut Communautaire  Africain de gestion  et d’ingénierie ICAGI",
        "Institut de Formation Aux Métiers Des Sports (IFM-SPORTS)",
        "INSTITUT DE FORMATION EN ADMINISTRATION DES AFFAIRES",
        "INSTITUT DE FORMATION EN TOURISME ET DE RESTAURATION (IFTR)",
        "Institut des  Ingénieurs en Informatique I3T",
        "INSTITUT DES METIERS DE LA MODE (I2M)",
        "Institut des Sciences et Métiers de la Mode ISMOD",
        "institut professionnel d'entreprise (IPE)",
        "Institut Sénégalais de Boulangerie et de Pâtisserie (ISBP)",
        "Institut Supérieur d’Entrepreneurship et de Gestion ISEG",
        "INSTITUT SUPERIEUR DE COMMERCE ET DE MANAGEMENT (ISCOM)",
        "Institut Supérieur de Formation aux Nouveaux Métiers Informatique et Communication ( UP TECH)",
        "Institut Supérieur de Formation aux nouveaux Métiers informatique et communication (UNIPRO",
        "Institut Supérieur de Formation et d’Appui à l’Insertion (ISFAP)",
        "INSTITUT SUPERIEUR DE TECHNOLOGIES (SUPTECH)",
        "Institut Supérieur d'Informatique « ISI»",
        "Institut Supérieur Privé de Management et d’Etude Commerciales(ISMEC)",
        "Institut Universitaire de l’Entreprise et du Développement (IUED)",
        "IPD Thomas Sankara",
        "IPROSI",
        "LA SOURCE",
        "Les Ecoles de Développement (EDD)",
        "LES MARMITONS",
        "POROKHANE COIFFURE",
        "SUPGES",
        "SUP-INFO",
        "Universat",
        "Institut Polyvalent de Formation Professionnelle yasser arafatIPFP",
        "Institut Technique de Commerce (ITECOM)",
        "CPFP ASAFIN",
        "Institut de Formation Professionnelle Institut Sainte Jeanne D'Arc-Post BAC",
        "ISCA",
        "SUPTEC BATIS",
        "New Africa Training ( Les écoles du Développement)",
        "BSA",
        "ESAS",
        "IFPM Rufisque",
        "Institut SABRARIFA",
        "XALIMA COUTURE FORMATION",
        "Olan CENTER ",
        "ESUMAQ",
        "Centre Coaching Africain",
        "Institut de génie rural et de l'environnement(IGRE)",
        "institut des métiers du droit et de l'immobilier(IMDI)",
        "AMDI",
        "CEFAS",
        "Hautes Etudes en Technologie et Administration des Affaires(HETAA)",
        "Ecole Supérieure de Management (ESM)",
        "Université Nelson Mandela (UNM)",
        "Institut Supérieur en Ecovillage Design",
        "Institut Supérieur d'Ingénieur et de Formation",
        "Centre de Formation Fantasika",
        "CERFA",
        "Institut Gestion des Carrières IGCP",
        "institut Professionnel de Formation en Sciences de la Santé (IPFOSS)",
        "Institut Supérieur des Sciences de la Santé",
        "Ecole de Santé Paul CORREA",
        "Institut Professionnel en Santé IPS",
        "Institut de santé FIDELIA",
        "Institut de Santé et des Etudes Paramédicales",
        "Institut de Santé Plus Privé (ISPP)",
        "Institut Socio- Sanitaire d’Apprentissage Professionnel ISSAP",
        "EFO SANTE",
        "Institut Universitaire Professionnelle en Santé",
        "IASM",
        "IFPS",
        "PERFORM",
        "ASSAPE-CEPPE",
        "ENSUP AFRIQUE",
        "Groupe Consultance Conseil Formations Hautes Etudes (G2CFOR)",
        "2IFA",
        "2IM",
        "COMPLEXE YACINE",
        "EMD",
        "EPACS",
        "IDM",
        "IICA",
        "Sénégal Business School",
        "IMFA",
        "COMPUTECH INSTITUTE",
        "EPISE-IMS",
        "Université Kéba",
        "IPH",
        "IBST",
        "Institut Supérieur des Arts et des Métiers Numériques",
        "Bill Job Institute",
        "Afia Center",
        "JPAC",
        "Maison d'Education Athena ",
        "HEKIMA SANTE",
        "Mirador Formation",
        "Ecole Internationale des Affaires (EIA)",
        "Institut de Formation Professionnelle en Esthétique (IFPE)",
        "Centre Social d’Entraide et d’Information (CSEI)",
        "Institut de Formation Hôtelière de Ouakam (IFHO)",
        "Complexe Sokhna Assiétou/Excellence",
        "Enda Graf Sahel",
        "Ecole de Formation en Sécurité Privée (EFSP)",
        "Ecole des Métiers Agro écologiques, Agroalimentaires du Sénégal (EMAAS",
        "E221",
        "CEFAS SANTE",
        "Cours Privés Exponentiel",
        "Centre Socio-Educatif Keur Don Bosco (CSE-KDB)",
        "Centre Trainamar de Dakar (CTD)",
        "Dakar Air Academy (DAA)",
        "Institut Supérieur d’Ingénierie  et de Formation-Business School (ISIF-BS)",
        "Lycée d'Excellence Mahmady (LEM)",
        "Centre Technique d' Apprentissage Saint Montfort (CTASM)",
        "Ecole Supérieure  de Commerce et des Affaires(ESCA)",
        "Ecomode-Plus (EP)",
        "Francophone Business School-Dakar ( FBS-DAKAR)",
        "Complexe Prince Coiffure (CPC)",
        "Complexe Taaru Ndeye Niang (CTNN)",
        "Cours Secondaire des Parcelles Assainies",
        "Dakar Business School (DBS)",
        "Ecole Supérieure de Logistique et des Transports (ESLOT)",
        "Ecole Supérieure de Management de Télécommunication d'Informatique et de Certification (ESMTIC)",
        "Institut Supérieur de Formation Professionnelle Ibni Academy (ISFPIA)",
        "AMDI INGENIERIE",
        "Institut de Commerce et Management (ICM)",
        "Institut de Formation de Secrétaires et de Comptables",
        "« Ecole Supérieur de l’Immobilier»(SUP-IMMO",
        "African Aviation Incoporation (2AI)",
        "African Business School",
        "américan institute for english language and entreneurship",
        "ANPS",
        "bakeli school of technologie",
        "CABIS SCHOOL",
        "centre bioforce Afrique",
        "Centre de formation aux métiers de la sécurité",
        "CENTRE DE FORMATION BOKK- DIOM",
        "Centre international supérieur aux techniques de soudage (CIS)",
        "Centre Privé Protestant de Formation Professionnelle",
        "COMPLEXE MAWA",
        "ECOLE INTERNATIONALE D'ESTHETIQUE (E.I.E)",
        "Ecole Professionnelle des Métiers de l'UPAM",
        "Etudes Harmonies Acoustique (EHA)",
        "Groupe Scolaire LES PEDAGOGUES",
        "HEG",
        "IESMD",
        "IMAN",
        "Institut Académique des Bébés (IAB)",
        "INSTITUT DE FORMATION AUX METIERS DE L'ENSEIGNEMENT IFMEN",
        "INSTITUT DE FORMATION DE PERSONNEL NAVIGANT DE CABINE",
        "Institut de Formation et d'Assistance (AFI",
        "Institut International des Sciences et de Technologie",
        "INSTITUT PANAFRICAINE DE MARKETING: IPAM",
        "Institut polytechnique du sahel(IPDS)",
        "INSTITUT SUPERIEUR D'ADMINISTRATION ET DE GESTION",
        "Institut Supérieur de Formation, d'Etudes, de conseils et de services(IFEC)",
        "INSTITUT SUPERIEUR D'ENSEIGNEMENT TECHNIQUE ET PROFESSIONNEL",
        "Institut Supérieur d'Ingénieur et de Formation",
        "Institution PAPA GUEYE FALL",
        "International Best Sécurity",
        "ISCM",
        "ISDL",
        "ISIT-A",
        "ISPAG",
        "ISTE",
        "ITTE",
        "La Désirade",
        "Ma formation serrurerie et ajustage clé",
        "sonatel Académy",
        "SUPER 3 D",
        "THYLIANE ACADEMIE",
        "Union pour la solidarité et l'entraide/Centre Ahmadou Malick Gaye",
        "UNIVERS DE LA MODE",
        "Université Africaine de Technologie et de Gestion(UATG)",
        "Université Europe Afrique",
        "Institut Africain des Etudes du Développement (IAED)",
        "Ecole Supérieure Aéronautique (ESA)",
        "Cours Privés Exponentielle (CPE)",
        "Ami Onglerie",
        "Mirador Formation",
        "AFRICOM/av",
        "Institut International de l'Entreprise (2IE)",
        "IT Shool",
        "Etablissements",
        "Centre Privé de Formation Commerciale du BAOL",
        "CENTRE SOCIO CULTUREL DE FORMATION PROFESSIONNELLE /SUNUGAL",
        "CENTRE D'INFORMATIQUE ET DE GESTTION APPLIQUEE (CIGA)",
        "COMPLEXE MAWA",
        "HAUTE ECOLE DE COUPE COUTURE HECC",
        "IACOM- PIKINE",
        "ICONE COM",
        "KER KEN CAP SUR L'AVENIR",
        "MBALLANE COUTURE",
        "Centre de Qualification Professionnelle CQP",
        "Institut Supérieur Privé de Management",
        "Ngayenne Coiffure Formation",
        "FOYERS SHAMA",
        "IGI",
        "SENSYS-ACADEMIE",
        "Timbereng School",
        "Institut de Formation Hôtelière (IFH)",
        "AMES",
        "Institut de Formation Professionnel aux métiers émergeants",
        "Complexe coiffure Biaritz",
        "Institut de Formation aux Carrières de Santé",
        "Al HAMDOULILAHI Couture",
        "ATAC FORMATION",
        "LA REFERENCE",
        "CERT KEUR MASSAR",
        "CFPA - ADS MBAO",
        "IFPT Keur Mbaye Fall",
        "IBS ",
        "IF3S",
        "Ecole de Formation en santé EFSA Baobab",
        "Ecole Hotellière de Gastromie  Communale ",
        "La plus belle",
        "Collège Technique Ibra Seck",
        "JEUNESSE CULTURE LOISIRS TECHNIQUES INTERVENTTIONS SOCIALES (JCLTIS)",
        "CENTRE DE FORMATION AIDA COUTURE",
        "ECOLE DES CHANTIERS STYLE ART",
        "EDITION COMMUNICATION (EDICOM)",
        "Wa Kêr Gi",
        "Centre International de Formation de Danses Traditionnelles et Contemporaines Ecole de Sables",
        "IFITSA",
        "Complexe  Sagesse (Coiffure-Couture)",
        "centre privé de formaton professionnelle des enseignants(CPFPE)",
        "auto académie",
        "Ecole Internationale de Biologie Appliquée EIBA",
        "Centre de formation et de perfectionnement en santé de Rufisque",
        "IPCI",
        "Institut Socio Saanitaire Professionnel aux Métiers de la Santé (ISPMS)",
        "Complexe de Beauté Union Africaine (CBUA)",
        "Complexe Royaume de l'Elégance (CRE)",
        "Ecole de Formation Professionnelle Tapis-Rouge (EFPTR)",
        "EFMA ECOLE DE FORMATION DES METIERS DE L'AVENIR",
        "Groupe Scolaire la Maïeutique (GSM)",
        "Institut Africain des Sciences Sociales Mame Diarra Bousso (IASSMDB)",
        "Centre de Formation Professionnelle Complexe de Couture et Coiffure Idoles (CFPCCC)",
        "Groupe Institut Elite-EBS Elite Business School (GIE-EBS)",
        "Univers de la Mode",
        "Angelas Davis",
        "Groupe Scolaire Educazur (GSE)",
        "Ndjiliwene Couture (NC)",
        "Complexe Mame Soda",
        "Global Energie Ecole de formation professionnelle et technique",
        "Brunello Bertoni",
        "centre de formation professionnelle et de perfectionnement aux métiers de l'industrie",
        "Centre Féminin de Formation Technique Communautaire de pikine",
        "COMPLEXE ADJA YACINE COIFFURE",
        "COMPLEXE ASSALY",
        "COPEL",
        "Ecole des métiers de la Couture",
        "ESICOM",
        "GLOBAL TECHNOLOGIY ASSISTANCE (GTA)",
        "GROUPE SCOLAIRE LE BAOBAB",
        "GROUPE SCOLAIRE MASAMBA",
        "GROUPE SYNERGIE MANAGEMENT",
        "IACOM- PIKINE",
        "IFCE/ PALAIS DE LA BEAUTE",
        "IFPM",
        "Institut Hair Universal",
        "institut supérieur et professionnel de l'emploi(ISPE)",
        "LA RIVE DU SAVOIR",
        "LA RUAH",
        "LA SOSSO",
        "TECHNISYS INFORMATIQUE",
        "Institut Africain Futurs Métiers (IAFM)",

        
    );

    public static $deja = array(

        "Oui",
        "Non",
    );

    public static $familiale = array(

        "Célibataire",
        "Marié(e)",
        "Veuf(ve)",
        "Divorcé(e)",
    );

    public static $lieunaissance = array(
        "Tambacounda",
        "Bakel",
        "Goudiry",
        "Koumpentoum",
        "Bignona",
        "Oussouye",
        "Ziguinchor",
        "Bambey",
        "Diourbel",
        "Mbacké",
        "Dagana",
        "Podor",
        "Saint-Louis",
        "Dakar",
        "Pikine",
        "Rufisque",
        "Guédiawaye",
        "Kaolack",
        "Nioro du rip",
        "Guinguinéo",
        "Mbour",
        "Thiès",
        "Tivaouane",
        "Kémémer",
        "Linguère",
        "Louga",
        "Fatick",
        "Foundiougne",
        "Gossas",
        "Kolda",
        "Vélingara",
        "Médina",
        "Kanel",
        "Matam",
        "Ranérou",
        "Kaffrine",
        "Birkelane",
        "Koungheul",
        "Malem-Hodar",
        "Kedougou",
        "Salemata",
        "Saraya",
        "Sédhiou",
        "Bounkiling",
        "Goudomp",
    );

    public static $diplome = array(

        "Certificat de fin d'étude élémentaire",
        "Brevet de fin d'étude moyen",
        "Baccalauréat",
        "Licence 1",
        "Licence 2",
        "Licence 3",
        "Master 1",
        "Master 2",
    );

    public static $diplomepro = array(

        "BTS",
        "BT",
        "BEP",
        "CAP",
    );

    public static $domaine = array(

        "Accueil - Secrétariat",
        "Agriculture - Agroalimentaire",
        "Architecture - Urbanisme",
        "Artisanat",
        "Arts - Audiovisuel",
        "Banque - Assurance",
        "Bâtiment - Travaux publics",
        "Bureautique",
        "Commerce - Vente",
        "Comptabilité - Finance - Gestion",
        "Développement personnel",
        "Droit - Juridique",
        "Édition - Presse - Médias",
        "Enseignement - Formation",
        "Esthétique - Beauté",
        "Graphisme - PAO CAO DAO",
        "Immobilier",
        "Industrie",
        "Informatique - Réseaux - Télécom",
        "Internet - Web",
        "Langues",
        "Lettres - Sciences humaines et sociales",
        "Management - Direction d'entreprise",
        "Marketing - Communication",
        "Mode - Textile",
        "Qualité - Sécurité - Environnement",
        "Ressources humaines",
        "Santé - Social",
        "Sciences",
        "Sport - Loisirs",
        "Tourisme - Hôtellerie - Restauration",
        "Transport - Achat - Logistique",



    );


    public static $name = array(
        "Badiane",
        "Badiatte",
        "Badji",
        "Biagui",
        "Bassène",
        "Bodian",
        "Coly",
        "Diamacoune",
        "Diatta",
        "Diadhiou",
        "Diédhiou",
        "Diémé",
        "Djiba",
        "Ehemba",
        "Goudiaby",
        "Himbane",
        "Mané",
        "Manga",
        "Sagna",
        "Sambou",
        "Sané",
        "Sonko",
        "Tamba",
        "Tendeng",
        "Badiane",
        "Bop",
        "Diaher",
        "Diène",
        "Dieye",
        "Dioh",
        "Diome",
        "Dione",
        "Diong",
        "Dior",
        "Diouf",
        "Dogue",
        "Faye",
        "Kital",
        "Kitane",
        "Mbaye",
        "Mbengue",
        "Ndiaye",
        "Ndiolène",
        "Ndione",
        "Ndong",
        "Ndour",
        "Ngom",
        "Niane",
        "Pouye",
        "Sagne",
        "Sarr",
        "Seck",
        "Sene",
        "Senghor",
        "Seye",
        "Thiandoum",
        "Thiaw",
        "Thiombane",
        "Thione",
        "Tine",
        "Youm",
        "Aïdara",
        "Athie",
        "Aw",
        "Ba",
        "Baby",
        "Baldé",
        "Barro",
        "Barry",
        "Bathily",
        "Boussou",
        "Camara",
        "Cissé",
        "Deme",
        "Dia",
        "Diamanka",
        "Diallo",
        "Diao",
        "Diaw",
        "Dimé",
        "Fassa",
        "Fofana",
        "Gadio",
        "Galadio",
        "Goloko",
        "Kâ",
        "Kane",
        "Maal",
        "Mbow",
        "Lo",
        "Ly",
        "Sall",
        "Seydi",
        "Sow",
        "Sy",
        "Sylla",
        "Tall",
        "Thiam",
        "Wane",
        "Wath",
        "Wone",
        "Yock",
        "Badjinka",
        "Coly",
        "Diandy",
        "Djighaly",
        "Dioma",
        "Diendiame",
        "Nango",
        "Badji",
        "Gomis",
        "Mané",
        "Vieira",
        "Carvalho",
        "Mendy",
        "Mané",
        "Preira",
        "Correia",
        "Basse",
        "Sylva",
        "Da Sylva",
        "Fernandez",
        "Da Costa",
        "Darmanko",
        "Amar",
        "Babou",
        "Diagne",
        "Diakhoumpa",
        "Goumbala",
        "Saady",
        "Sabara",
        "Sougou",
        "Sougoufara",
        "Tandiné",
        "Tandini",
        "Touré",
        "Bakhoum",
        "Diop",
        "Diagne",
        "Gaye",
        "Gueye",
        "Ndoye",
        "Ndiour",
        "Ndir",
        "Samb",
        "Sadio",
        "Vieira",
        "Lopez",
        "Marques",
        "Yalla",
        "Preira",
        "Boubane",
        "Bonang",
        "Bianquinch",
        "Bindian",
        "Bendian",
        "Bangonine",
        "Bapinye",
        "Bidiar",
        "Bangar",
        "Biès",
        "Boye",
        "Cobar",
        "Demba",
        "Dembelé",
        "Diack",
        "Diarra",
        "Diaw",
        "Dieng",
        "Diong",
        "Diop",
        "Fall",
        "Gning",
        "Guène",
        "Hanne",
        "Kane",
        "Kassé",
        "Lèye",
        "Loum",
        "Marone",
        "Mbacké",
        "Mbathié",
        "Mbaye",
        "Mbengue",
        "Mbodj",
        "Mbodji",
        "Mboup",
        "Mbow",
        "Ndao",
        "Ndaw",
        "Nder",
        "Ndiaye",
        "Ndiongue",
        "Ndour",
        "Nger",
        "Niane",
        "Niang",
        "Niass",
        "Niasse",
        "Seck",
        "Sock",
        "Taye",
        "Thiam",
        "Thiongane",
        "Wade",
        "Aïdara",
        "Bathily",
        "Bayo",
        "Camara",
        "Cissé",
        "Cissoko",
        "Coulibaly",
        "Dabo",
        "Demba",
        "Doumbia",
        "Doumbouya",
        "Diabang",
        "Diabira",
        "Diagana",
        "Diakhaby",
        "Diakhaté",
        "Diakité",
        "Dansokho",
        "Diakho",
        "Diarra",
        "Diawara",
        "Dibané",
        "Djimera",
        "Dramé",
        "Doucouré",
        "Fadiga",
        "Faty",
        "Fofana",
        "Gakou",
        "Gandega",
        "Gassama",
        "Kanté",
        "Kanouté",
        "Kébé",
        "Keïta",
        "Koïta",
        "Konaté",
        "Koroboume",
        "Marega",
        "Niangane",
        "Sabaly",
        "Sadio",
        "Sakho",
        "Samassa",
        "Sané",
        "Sawane",
        "Sidibé",
        "Sissoko",
        "Soukho",
        "Soumaré",
        "Tamba",
        "Tambadou",
        "Tambedou",
        "Tandia",
        "Tandian",
        "Tandjigora",
        "Timera",
        "Traoré",
        "Touré",
        "Wagué",
        "Yatéra",
        "Bacourine",
        "Badiete",
        "Bakilane",
        "Baloucoune",
        "Bampoky",
        "Bandagny",
        "Bandiacky",
        "Banko",
        "Baraye",
        "Bathé",
        "Boissy",
        "Cabateau",
        "Campal",
        "Damany",
        "Diompy",
        "Dionou",
        "Dupa",
        "Kabely",
        "Kadiagal",
        "Kadionane",
        "Kagnaly",
        "Kaly",
        "Kanfany",
        "Kanfome",
        "Kanfoudy",
        "Kanpintane",
        "Kantoussan",
        "Kassoka",
        "Kayounga",
        "Keny",
        "Malack",
        "Malèle",
        "Maleumane",
        "Malomar",
        "Malou",
        "Mandika",
        "Mandiouban",
        "Mancabou",
        "Mancore",
        "Mandiamé",
        "Manel",
        "Mansall",
        "Manta",
        "Mantanne",
        "Maty",
        "Mbampassy",
        "Médou",
        "Minkette",
        "Mpamy",
        "Nabaline",
        "Nadiack",
        "Nakouye",
        "Namatane",
        "Nankasse",
        "Nanssalan",
        "Napel",
        "Nataye",
        "Nawoutane",
        "Ndecky",
        "Ndeye",
        "Ndione",
        "Ndô",
        "Ndouikane",
        "Niouky",
        "Ntab",
        "Nzale",
        "Oudiane",
        "Panduppy",
        "Samy",
        "Sanka",
    );
    public static $firstName = array (
    "Abba",
    "Abdallah",
    "Abdou",
    "Abdoulatif",
    "Abdoulaye",
    "Abdourahmane",
    "Ablaye",
    "Abou",
    "Adama",
    "Adiouma",
    "Agouloubene",
    "Aïdara",
    "Aïnina",
    "Aladji",
    "Alassane",
    "Albouri",
    "Alfa",
    "Alfousseyni",
    "Aliou",
    "Alioune",
    "Allé",
    "Almamy",
    "Amadou",
    "Amara",
    "Amath",
    "Amidou",
    "Ansoumane",
    "Anta",
    "Arfang",
    "Arona",
    "Assane",
    "Asse",
    "Aziz",
    "Baaba",
    "Babacar",
    "Babou",
    "Badara",
    "Badou",
    "Bacar",
    "Baïdi",
    "Baila",
    "Bakari",
    "Ballago",
    "Bamba",
    "Banta",
    "Bara",
    "Bassirou",
    "Bathie",
    "Bayo",
    "Becaye",
    "Bilal",
    "Biram",
    "Birane",
    "Birima",
    "Biry",
    "Bocar",
    "Bodiel",
    "Bolikoro",
    "Boubacar",
    "Boubou",
    "Bougouma",
    "Bouly",
    "Bouna",
    "Bourkhane",
    "Bransan",
    "Cheikh",
    "Chérif",
    "Ciré",
    "Daly",
    "Damé",
    "Daouda",
    "Daour",
    "Demba",
    "Dényanké",
    "Diakhou",
    "Dial",
    "Dialamba",
    "Dialegueye",
    "Dianco",
    "Dicory",
    "Diégane",
    "Diène",
    "Dierry",
    "Diewo",
    "Diokel",
    "Diokine",
    "Diomaye",
    "Dior",
    "Djibo",
    "Djibril",
    "Djiby",
    "Djily",
    "Doudou",
    "Dramane",
    "El Hadj",
    "Elimane",
    "Facourou",
    "Fadel",
    "Falilou",
    "Fallou",
    "Famara",
    "Farba",
    "Fédior",
    "Fatel",
    "Fodé",
    "Fodey",
    "Fodié",
    "Foulah",
    "Galaye",
    "Gaoussou",
    "Gora",
    "Gorgui",
    "Goumbo",
    "Goundo",
    "Guidado",
    "Habib",
    "Hadiya",
    "Hady",
    "Hamidou",
    "Hammel",
    "Hatab",
    "Iba",
    "Ibrahima",
    "Ibou",
    "Idrissa",
    "Insa",
    "Ismaïl",
    "Ismaïla",
    "Issa",
    "Isshaga",
    "Jankebay",
    "Jamuyon",
    "Kader",
    "Kainack",
    "Kalidou",
    "Kalilou",
    "Kambia",
    "Kao",
    "Kaourou",
    "Karamo",
    "Kéba",
    "Khadim",
    "Khadir",
    "Khalifa",
    "Khamby",
    "Khary",
    "Khoudia",
    "Khoule",
    "Kor",
    "Koutoubo",
    "Lamine",
    "Lamp",
    "Landing",
    "Lat",
    "Latif",
    "Latsouck",
    "Latyr",
    "Lémou",
    "Léou",
    "Leyti",
    "Libasse",
    "Limane",
    "Loumboul",
    "Maba",
    "Macky",
    "Macodou",
    "Madia",
    "Madické",
    "Mady",
    "Mactar",
    "Maffal",
    "Maguette",
    "Mahécor",
    "Makan",
    "Malal",
    "Malamine",
    "Malang",
    "Malanh",
    "Malaw",
    "Malick",
    "Mallé",
    "Mamadou",
    "Mamour",
    "Mansour",
    "Maodo",
    "Mapaté",
    "Mar",
    "Massamba",
    "Massar",
    "Masseck",
    "Mbagnick",
    "Mbakhane",
    "Mbamoussa",
    "Mbar",
    "Mbaye",
    "Mébok",
    "Médoune",
    "Meïssa",
    "Mody",
    "Modou",
    "Moktar",
    "Momar",
    "Mor",
    "Mountaga",
    "Moussa",
    "Moustapha",
    "Namori",
    "Ndane",
    "N deupp",
    "Ndiack",
    "Ndiaga",
    "Ndiankou",
    "Ndiasse",
    "Ndiaw",
    "Ndiawar",
    "Ndiaya",
    "Ndiogou",
    "Ndiouga",
    "Ndongo",
    "Ngagne",
    "Ngor",
    "Nguénar",
    "Niakar",
    "Niankou",
    "Niokhor",
    "Nouh",
    "Nouha",
    "Npaly",
    "Ogo",
    "Omar",
    "Opa",
    "Oumar",
    "Oury",
    "Ousmane",
    "Ousseynou",
    "Papa",
    "Pape",
    "Papis",
    "Pathé",
    "Racine",
    "Sadibou",
    "Sacoura",
    "Saër",
    "Sahaba",
    "Saïdou",
    "Seydou",
    "Sakhir",
    "Salam",
    "Salif",
    "Saliou",
    "Saloum",
    "Samba",
    "Samori",
    "Samsidine",
    "Sandigui",
    "Sankoun",
    "Sanokho",
    "Sécouba",
    "Sédar",
    "Sékou",
    "Semou",
    "Senghane",
    "Serigne",
    "Seyba",
    "Seydina",
    "Seydou",
    "Sibiloumbaye",
    "Sidate",
    "Sidy",
    "Siéka",
    "Sihalébé",
    "Sihounke",
    "Silly",
    "Socé",
    "Sogui",
    "Soireba",
    "Solal",
    "Sonar",
    "Souleymane",
    "Soundjata",
    "Sounkarou",
    "Souty",
    "Tafsir",
    "Talla",
    "Tamsir",
    "Tanor",
    "Tayfor",
    "Tekheye",
    "Tété",
    "Thiarro",
    "Thiawlo",
    "Thierno",
    "Thione",
    "Tijane",
    "Tidjane",
    "Toumani",
    "Vieux",
    "Wagane",
    "Waly",
    "Wandifing",
    "Wasis",
    "Woula",
    "Woury",
    "Yacine",
    "Yacouba",
    "Yafaye",
    "Yakou",
    "Yamar",
    "Yankhoba",
    "Yerim",
    "Yero",
    "Yoro",
    "Yougo",
    "Younouss",
    "Youssou",
    "Youssouf",
    "Youssoufa",
    "Abibatou",
    "Aby",
    "Absa",
    "Adama",
    "Adiouma",
    "Adji",
    "Adja",
    "Aïcha",
    "Aïda",
    "Aïssatou",
    "Akinumelob",
    "Alima",
    "Alimatou",
    "Alinsiitowe",
    "Aloendisso",
    "Altine",
    "Ama",
    "Aminata",
    "Amincta",
    "Amy",
    "Anta",
    "Arame",
    "Assa",
    "Assietou",
    "Astou",
    "Ata",
    "Atia",
    "Awa",
    "Awentorébé",
    "Ayimpen",
    "Banel",
    "Batouly",
    "Bigué",
    "Billé",
    "Bincta",
    "Bineta",
    "Binette",
    "Binta",
    "Bintou",
    "Birame",
    "Biram",
    "Boirika",
    "Bougouma",
    "Boury",
    "Bousso",
    "Ciramadi",
    "Codou",
    "Combé",
    "Coudouution",
    "Coumba",
    "Coumboye",
    "Coura",
    "Daba",
    "Dado",
    "Daka",
    "Daly",
    "Debbo",
    "Défa",
    "Dewel",
    "Dewene",
    "Diadji",
    "Diaga",
    "Diakher",
    "Diakhou",
    "Dialikatou",
    "Diama",
    "Diangou",
    "Dianké",
    "Diariatou",
    "Diarra",
    "Diara",
    "Diary",
    "Dibor",
    "Dieourou",
    "Dior",
    "Diouma",
    "Djaly",
    "Djébou",
    "Djeynaba",
    "Dkikel",
    "Djilane",
    "Enfadima",
    "Fabala",
    "Fabinta",
    "Fadima",
    "Fakane",
    "Fama",
    "Fanta",
    "Farmata",
    "Fatima",
    "Fatou",
    "Fatoumatou",
    "Fily",
    "Garmi",
    "Gnagna",
    "Gnilane",
    "Gnima",
    "Gouya",
    "Guignane",
    "Guissaly",
    "Haby",
    "Hawa",
    "Heinda",
    "Holèl",
    "Issate",
    "Kankou",
    "Karimatou",
    "Kenbougoul",
    "Kéwé",
    "Kadiali",
    "Khadija",
    "Khadijatou",
    "Khady",
    "Khar",
    "Khary",
    "Khayfatte",
    "Khoudia",
    "Khoudjedji",
    "Khoumbaré",
    "Kiné",
    "Korka",
    "Laf",
    "Laff",
    "Laffia",
    "Lama",
    "Léna",
    "Lika",
    "Lissah",
    "Liwane",
    "Mada",
    "Madior",
    "Madjiguène",
    "Maguette",
    "Mahawa",
    "Mame",
    "Mamina",
    "Manthita",
    "Marème",
    "Mariama",
    "Mamassa",
    "Mane",
    "Maty",
    "Mayatta",
    "Maymouna",
    "Mbacké",
    "Mbarou",
    "Mbayeng",
    "Mbissine",
    "Mbossé",
    "Meïssa",
    "Mingue",
    "Mouskéba",
    "Nafi",
    "Nbieumbet",
    "Ndebane",
    "Ndella",
    "Ndeye",
    "Ngoundj",
    "Ndiarenioul",
    "Ndiarka",
    "Ndiasse",
    "Ndiaty",
    "Ndiémé",
    "Ndioba",
    "Ndiolé",
    "Ndioro",
    "Ndoffène",
    "Ndombo",
    "Néné",
    "Neyba",
    "Ngoné",
    "Ngosse",
    "Nguenar",
    "Nguissaly",
    "Niakuhufosso",
    "Niali",
    "Nialine",
    "Ningou",
    "Nini",
    "Niouma",
    "Oulèye",
    "Oulimata",
    "Oumou",
    "Oumy",
    "Oureye",
    "Penda",
    "Peye",
    "Peye",
    "Raby",
    "Raki",
    "Rama",
    "Ramata",
    "Ramatoulaye",
    "Rokhaya",
    "Roubba",
    "Roughy",
    "Sadio",
    "Safiétou",
    "Safi",
    "Sagar",
    "Sahaba",
    "Salimata",
    "Salamata",
    "Sanakha",
    "Sarratou",
    "Saoudatou",
    "Sawdiatou",
    "Selbé",
    "Sell",
    "Seynabou",
    "Seyni",
    "Sibett",
    "Siga",
    "Sira",
    "Sirabiry",
    "Soda",
    "Sofiatou",
    "Sofietou",
    "Sokhna",
    "Sonar",
    "Souadou",
    "Soukeye",
    "Soukeyna",
    "Tabara",
    "Tacko",
    "Taki",
    "Tening",
    "Téwa",
    "Tiné",
    "Thiame",
    "Thiomba",
    "Thiony",
    "Thioro",
    "Thioumbane",
    "Tocka",
    "Tokoselle",
    "Toly",
    "Walty",
    "Yadicone",
    "Yacine",
    "Yandé",
    "Yandou",
    "Yaye",
    "Adama",
    "Adiouma",
    "Anta",
    "Birame",
    "Bodiel",
    "Bougouma",
    "Ciré",
    "Daly",
    "Diéry",
    "Khar",
    "Lika",
    "Maguette",
    "Meïssa",
    "Ndiasse",
    "Sagar",
    "Sanou",
    "Yacine",
    );

    /**
     *  Name generator
     *  
     * @function to generate random name
     * @return   name(String)
     */
    static function getName()
    {
        $dimension=count(self::$name);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$name[$random_index];


    }
    /**
     * FirstName generator
     * 
     * @function to generate random firstName
     * @return   firstName(String)
     */
    static function getFirstName()
    {
        $dimension=count(self::$firstName);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$firstName[$random_index];


    }

    static function getCivilite()
    {
        $dimension=count(self::$civilite);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$civilite[$random_index];


    }
    static function getDirection()
    {
        $dimension=count(self::$direction);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$direction[$random_index];


    }

    static function getSigledirection()
    {
        $dimension=count(self::$sigledirection);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$sigledirection[$random_index];


    }

    static function getSituationeconomique()
    {
        $dimension=count(self::$situationeconomique);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$situationeconomique[$random_index];


    }
    
    static function getSituation()
    {
        $dimension=count(self::$situation);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$situation[$random_index];


    }

    static function getStatut()
    {
        $dimension=count(self::$statut);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$statut[$random_index];

    }
    
    static function getTypesstructure()
    {
        $dimension=count(self::$typesstructure);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$typesstructure[$random_index];

    }

    static function getHandicap()
    {
        $dimension=count(self::$handicap);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$handicap[$random_index];

    }

    static function getTravailrenumeration()
    {
        $dimension=count(self::$travailrenumeration);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$travailrenumeration[$random_index];

    }

    static function getVictime_social()
    {
        $dimension=count(self::$victime_social);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$victime_social[$random_index];

    }

    static function getNiveaux()
    {
        $dimension=count(self::$niveaux);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$niveaux[$random_index];


    }
    
    static function getSexe()
    {
        $dimension=count(self::$sexe);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$sexe[$random_index];


    }

    static function getEtablissement()
    {
        $dimension=count(self::$etablissement);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$etablissement[$random_index];
    }

    static function getDeja()
    {
        $dimension=count(self::$deja);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$deja[$random_index];
    }
    
    static function getFamiliale()
    {
        $dimension=count(self::$familiale);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$familiale[$random_index];

    }

    static function getLieunaissance()
    {
        $dimension=count(self::$lieunaissance);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$lieunaissance[$random_index];

    }

    static function getDomaine()
    {
        $dimension=count(self::$domaine);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$domaine[$random_index];


    }

    static function getDiplome()
    {
        $dimension=count(self::$diplome);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$diplome[$random_index];

    }

    static function getDiplomepro()
    {
        $dimension=count(self::$diplomepro);
        $random_index=random_int(0, (int)$dimension-1);
        return self::$diplomepro[$random_index];

    }
}

