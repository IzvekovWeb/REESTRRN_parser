<?php

error_reporting(E_ALL);
ini_set("display_errors", 1); 

require('functions/news_func.php');
require('functions/function.php');
require('libs/phpQuery/phpQuery.php');
include('../vendor/autoload.php'); //Подключаем библиотеку
require('libs/telegram/TelegramBot.php');
require('parsers/SiteParser.php');
 
// file_put_contents('log.txt', 'Программа запущена ' . date('Y-m-d H:i:s') . '<br>', FILE_APPEND);

$t_bot = new Telegram();
$new_news_companies = Array();
$new_news_words = Array();
 

$words = ['acquire','agreed to buy', 'reports preliminary', 'expecting record performance', 'covid', 'the'];
$companies = ["Sierra","Aaron's", "Vontier","American Outdoor","Henkel","VOLKSWAGEN","Bayerische Motoren","METRO","Covestro","adidas","Carl Zeiss Meditec","Allianz","METRO","BASF","Bayer","Beiersdorf","HUGO BOSS","Borussia Dortmund","Continental","Daimler","Deutsche Boerse","Deutsche Bank","Delivery Hero","Deutsche Post","Deutsche Telekom","Deutsche Wohnen","E.ON SE","Evonik Industries","Evotec","Fielmann","Fresenius Medical","Fresenius","Bilfinger","HeidelbergCement","Henkel","Hapag-Lloyd","HOCHTIEF","Infineon Technologies","InVision","KUKA Aktiengesellschaft","Deutsche Lufthansa","MorphoSys","MERCK","MTU Aero Engines","Munchener","ProSiebenSat","Puma","Rheinmetall","RWE Aktiengesellschaft","Siemens","Suedzucker","thyssenkrupp","Talanx","Uniper","United Internet","VARTA","Villeroy & Boch","Vonovia","VOLKSWAGEN","WW International","ABM Industries","ShotSpotter","Federal Signal","BancFirst","OGE Energy","Cloudera","BridgeBio","B&G Foods","SBA Communications","Americold Realty Trust","Ameris Bancorp","Oxford Industries","Luminex","Digital Turbine","Eagle Bancorp","ServisFirst","Kaman","Boise Cascade","Cabot","DraftKings","Aprea","STAG Industrial","Cryoport","LeMaitre Vascular","Cue Biopharma","Camden National","United Fire Group","Sonic Automotive","EnPro Industries","Heidrick & Struggles","CNA Financial","Equity LifeStyle","CBIZ","Hyster-Yale","Brinker International","Arcosa","Invitation Homes","CyrusOne","Triumph Bancorp","Ping Identity","CoreSite Realty","RE/MAX Holdings","M.D.C. Holdings","Ally Financial","EchoStar","TTEC Holdings","DISH Network","AZZ inc","Century Communities","Avantor","CNX Resources","Independent Bank Group","Astec Industries","Argan","Jabil","WSFS Financial","Simulations Plus","Universal Electronics","Healthcare Trust of America","ZoomInfo Technologies","Shoe Carnival","Altra Industrial","Kforce","Bloomin' Brands","Stoke Therapeutics","Quanterix","Hawaiian Electric","Omega Healthcare","Dicerna Pharmaceuticals","Gentex","Schweitzer-Mauduit","ViaSat","Cytokinetics","Assembly Biosciences","Tricida","NGM Biopharmaceuticals","Akero Therapeutics","Alector","Comfort Systems","Powell Industries","Service International","PROS Holdings","Stewart Information Services","Allegiance Bancshares","Duke Realty","Axonics Modulation","Inari Medical","Commercial Metals","Trustmark","Fidelity National","UGI","Reynolds Consumer","Cannae Holdings","Nikola","Avnet","Federated Hermes","Allegheny Technologies","Matthews International","American Eagle","Rent-A-Center","Clearway Energy","Box inc","Universal","Health Catalyst","Eidos Therapeutics","Vir Biotechnology","Twist Bioscience","Slack Technologies","Medallia","Terreno Realty","Sanmina","Model N","SiTime","Helios Technologies","Adaptive Biotechnologies","HomeStreet","Washington Federal","Kulicke and Soffa","Horace Mann Educators","Enterprise Financial Services","Energizer Holdings","SpringWorks Therapeutics","Silgan Holdings","Silk Road Medical","Phibro Animal Health","Apellis Pharmaceuticals","Lakeland Financial","The Chemours","Air Transport Services","Axalta Coating","Nordic American Tankers","Farfetch","Afya","XP inc","InMode","Compugen","Spotify","Core Laboratories","Clarivate","Janus Henderson Group","Amcor","Barnes Group","Essential Utilities","Brooks Automation","TriCo Bancshares","DMC Global","Chewy","United Bankshares","Acushnet Holdings","Otter Tail","South Jersey Industries","Castle Biosciences","S&T Bancorp","Getty Realty","Haynes International","International Bancshares","Virgin Galactic","Steven Madden,","Standard Motor","Peoples Bancorp","Computer Programs and Systems","Marten Transport,","First Merchants","Rush Enterprises","PAR Technology","Phathom Pharmaceuticals","TechTarget","The RMR Group","NBT Bancorp","Sandy Spring Bancorp","Innovative Industrial","EastGroup Properties","1st Source","First Bancorp","ChoiceOne Financial Services","Avista","Columbia Banking System","Southside Bancshares","Banner","Webster Financial","BJ's Wholesale Club","Arcutis Biotherapeutics","LTC Properties","Ebix","CryoLife","CTS corporation","Cantel Medical","BankUnited","ACI Worldwide","Abercrombie & Fitch","CVR Energy","Flowers Foods","Gaming and Leisure","First Financial Bankshares","PNM Resources","NAPCO Security","MDU Resources","Penske Automotive","TriMas","Mueller Industries","Amicus Therapeutics","PetMed Express","Heartland Financial","Advanced Drainage","Lattice Semiconductor","Grocery Outlet","Flagstar Bancorp","Arcus Biosciences","QTS Realty Trust","Interactive Brokers","Axcelis Technologies","Schneider National","Core-Mark","Hannon Armstrong","MGP Ingredients","Hillenbrand","KB Home","Cathay General","Turning Point","Iridium Communications","World Fuel Services","Douglas Dynamics","Artisan Partners","La-Z-Boy Incorporated","Louisiana-Pacific","FB Financial","i3 Verticals","ViacomCBS","Loral Space","Scholastic","Ares Capital","KKR","StoneX Group","Virtu Financial","CIT Group","National Fuel Gas","Brixmor","Y-mAbs","Relmada Therapeutics","Intra-Cellular","First Citizens","Coca-Cola","Mesa Laboratories","Stamps.com","Molina Healthcare","National Western Life","Quaker Chemical","Kinsale","J & J Snack Foods","Carvana","Stepan","Alamo Group","Intercept","IDACORP","Lindsay","Virtus Investment","10x Genomics","LCI Industries","Kadant","National Presto","Bill.com Holdings","Karuna Therapeutics","ESCO Technologies","ONE Gas","CrowdStrike","Cogent Communications","Marriott","Southwest Gas","Innospec","Spire","U.S. Physical Therapy","CONMED","John Bean","Dunkin Brands","Hamilton","Exponent","GCI Liberty","Independent Bank","Middlesex Water","Cohen & Steers","Houlihan Lokey","Goosehead Insurance","Enphase Energy","Krystal Biotech","Tradeweb Markets","Schrodinger","IGM Biosciences","AMERISAFE","City Holding","ICF International","Cardlytics","GATX","ChemoCentryx","Evergy","ACM Research","NorthWestern Corp","SJW Group","Westamerica Ban","Arvinas","Kodiak Sciences","ATN International","Turning Point","ALLETE","PriceSmart","Tennant","Deciphera","Piper Sandler","Applied Industrial","Anterix","Albany International","Constellation","Viela Bio","Nicolet","McGrath","EverQuote","Casella","Applied Therapeutics","Vectrus","AAON","PJT Partners","PTC Therapeutics","AtriCure","Franklin Electric","Unitil","BioXcel","CEVA","Dynatrace","Cloudflare","Progyny","Arcturus","Peloton","Neenah","Natera","Cortexyme","OrthoPediatrics","Forward Air","CSG Systems","California Water","Encore Wire","Minerals Technologies","Black Diamond","Portland General Electric","Dell technologies","frontdoor","NXP Semiconductors","Check Point Software","WillScot","IAC/InterActiveCorp","Match Group","Reinsurance Group of America","Bio-Techne","Hill-Rom","IDEX","Cable One","Wintrust Financial","American Financial Group","Commerce Bancshares","Eaton Vance","CMC Materials","HEICO","Littelfuse","West Pharmaceutical","Evercore","National Instruments","Science Applications","Brown & Brown","Curtiss-Wright","Monro","Lancaster","Hubbell","Sonoco","Pinnacle","EMCOR Group","Graco","ITT inc","Cullen/Frost","Hanover Insurance","BWX Technologies","EnerSys","Medifast","Tetra Tech","Kemper","Donaldson","AptarGroup","FirstCash","Choice Hotels","Prosperity Bancshares","Tabula Rasa","WD-40","Glacier Bancorp","Nevro","Community Bank System","Moelis","Brady","BOK Financial","Morningstar","Teladoc","Parsons","Red River","MSA Safety","Compass Minerals","Bank of Hawaii","Selective Insurance","Regal Beloit","Valmont Industries","CSX","Stifel Financial","UMB Financial","Primerica","W. R. Berkley","The New York Times","Jack in the Box","Landstar System","Monolithic Power","Royal Gold","East West Bancorp","MKS Instruments","Leidos Holdings","LPL Financial","Entegris","CDK Global","Yum","AmerisourceBergen","American Water Works","CDW","Lamb Weston","Domino's Pizza","T-Mobile","Madison Square Garden","Otis Worldwide","Carrier Global","Arconic","Change Healthcare","Ingersoll Rand","Ovintiv","Global Net Lease","Sabra Health","Chatham Lodging","CorEnergy","Kite Realty","Apple Hospitality","Spirit Realty","Datadog","O-I Glass","Коммерческий центр","Spectrum Brands","AECOM","Addus","Aerie Pharmaceuticals","Agios Pharmaceuticals","ANGI Homeservices","ANI Pharmaceuticals","Arena Pharmaceuticals","Atara Biotherapeutics","Builders FirstSource","Boot Barn Holdings","Cara Therapeutics","Colfax","Corcept Therapeutics","Cardiovascular","Cornerstone","Catalent","Darling Ingredients","Echo Global Logistics","Encore Capital","8x8","Eagle Pharmaceuticals","eHealth","Esperion","1-800-FLOWERS.COM","Ferro","FormFactor","Gray Television","Halozyme","The Howard Hughes","Hibbett Sports","Heron Therapeutics","Harsco","Inphi","LivePerson","K12","MRC Global","MGIC Investment","Meritor","MaxLinear","NCR Corp","NetScout Systems","NV5 Global","Oceaneering","Oil States International","OraSure","Pacira BioSciences","Pilgrims Pride","PRA Group","Perficient","Renewable Energy","Rexnord","Sally Beauty","Stoneridge","STAAR Surgical","Supernus","Synaptics","Tucows","TreeHouse Foods","TTM Technologies","Ultra Clean","Univar Solutions","Vocera","Vonage Holdings","Vanda Pharmaceuticals","Varonis Systems","World Acceptance","Acceleron Pharma","Zogenix","Zumiez","Vericel","Shenandoah","Duluth Holdings","M/I Homes","BMC Stock","Trupanion","nLIGHT","Marcus & Millichap","G1 Therapeutics","Seacoast Banking","Malibu Boats","The Simply Good Foods","PGT Innovations","The Chefs Warehouse","Focus Financial Partners","Lantheus","Smith & Wesson","ePlus","Intellia","NMI Holdings","Altair Engineering","Zynerba","Heska","Fastly","Pinterest","Revolve Group","Beyond Meat","Zynex","Post Holdings","Redfin","Integer Holdings","Balchem","QuinStreet","Magnolia Oil & Gas","Sonos","Funko","Denali Therapeutics","Hostess Brands","Xencor","Western Alliance","Everbridge","REGENXBIO","Rapid7","Madrigal","Aerojet Rocketdyne","YETI","NeoGenomics","CareDx","Murphy USA","BlackLine","ProPetro Holding","Editas Medicine",
"Reata Pharmaceuticals","Q2 Holdings","Moderna","Glaukos","Tactile Systems","Iovance","USANA Health","Appian","Yext","Workiva","Veracyte","Inspire Medical","Axos Financial","Allogene","Upwork","Fate Therapeutics","Axogen","AppFolio","Freshpet","Freedom Holding","The Pennant Group","PagSeguro Digital","Xerox Holdings","Manchester United","Skechers U.S.A.","Crocs","Credit Acceptance","Commvault Systems","Evolent Health","HD Supply","GreenSky","SolarWinds","Smartsheet","PTC inc","HubSpot","Blueprint Medicines","Sarepta","TCR2Therapeutics","Sage Therapeutics","Alnylam","bluebird bio","JELD-WEN","Allscripts Healthcare Solutions","Cars.com","Qurate Retail","Pluralsight","Select Energy Services","TRI Point","Switch","Exact Sciences","Verint Systems","Quotient Technology","Pure Storage","Altice USA","Madison Square Garden","Axsome","MongoDB","Berkshire Hathaway","Arrowhead","Sprouts Farmers","Guardant Health","Mirati","Gossamer Bio","Neurocrine","Ligand","ACADIA","Tandem Diabetes","DexCom","Turtle Beach","iRhythm","FibroGen","Invitae","Nektar Therapeutics","Okta","DocuSign","Dropbox","PagerDuty","Anaplan","New Relic","Fair Isaac","Zoom Video","Nutanix","Zuora","BioMarin","Five9","Shockwave Medical","Chegg","Snap","Zillow","Avalara","Proofpoint","CoStar Group","BioTelemetry","Taylor Morrison","Cree inc","Legacy Housing","Tenable Holdings","Exelixis","RingCentral","Ollies Bargain","Atkore International","MSG Networks","Ultragenyx","US Foods Holding","Global Blood","GMS","Insulet","Live Nation Entertainment","Seagen","Markel","Ciena","The Hain Celestial","Euronet Worldwide","Uber","Corteva","DuPont","Crown Holdings","LiveRamp","Edgewell","Arrow Electronics","Meritage Homes","CoreLogic","Adtalem","Avanos Medical","Penumbra","TopBuild","Genesco","Envestnet","Ingevity","SPX FLOW","Bright Horizons","Cooper-Standard","Virtusa","Veritiv","Hilton Grand","Americas Car-Mart","American Public Education","PC Connection","Vishay Precision","MYR Group","SailPoint Technologies","Alleghany","Stitch Fix","Forrester Research","Monarch Casino","Roku","Lumentum","Zscaler","Sleep Number","Coupa Software","Beacon Roofing","CarGurus","Ionis","Medpace Holdings","GCP Applied","Axon Enterprise","UFP Industries","SVB Financial","National Vision","Aspen Technology","Syneos","Texas Capital Bancshares","Premier inc","Coherent","Alarm.com","Masimo","LGI Homes","Prestige Consumer","LendingTree","Omnicell","ICU Medical","AnaptysBio","National Beverage","MyoKardia","Fox Factory","LHC Group","Vicor","Quidel","Sykes Enterprises","Saia","Plexus","Central Garden & Pet","Varex Imaging","Allakos","Neogen","SPS Commerce","Itron","Winnebago","Gibraltar","Bandwidth","Onto Innovation","Dorman Products","PetIQ","CSW Industrials","Orthofix Medical","Heritage-Crystal","Huron Consulting","RBC Bearings","MicroStrategy Incorporated","CorVel","Cavco Industries","Surmodics","SP Plus","FRP Holdings","Levi Strauss","Lyft","Twilio","AdvanSix","TPI Composites","Rhythm Pharmaceuticals","The Trade Desk","Discovery","Kontoor Brands","Dow inc","Wayfair","Delek","Burlington Stores","GrubHub","Methode Electronics","Telephone and Data Systems","Chemed","Worthington Industries","Installed Building Products","Cooper Tire","Dril-Quip","Cactus","Alteryx","Black Knight","Terminix Global Holdings","Shutterstock","Korn Ferry","Vmware","PBF Energy","Aramark","Southern Copper","Knight-Swift Transportation Holdings","Kennametal","WESCO International","Cinemark Holdings","Performance Food","Dolby","Yelp","Zendesk","World Wrestling","GoDaddy","Veoneer","Rayonier","Haemonetics","IQVIA Holdings","Elanco Animal Health","Planet Fitness","Clean Harbors","WEX","SiteOne Landscape Supply","Biglari Holdings","AMN Healthcare Services","Charles River Laboratories","Floor & Decor","Avient","W.R. Grace","Dick's Sporting","Rhythm Pharmaceuticals","Matson","Toll Brothers","Tempur Sealy","Timken","Wolverine","MEDNAX","Visteon","Herman Miller","II-VI Incorporated","Teradyne","Bottomline Technologies","The Andersons","Sinclair Broadcast","2U","ABIOMED","Astronics","Patrick Industries","Steel Dynamics","Columbus McKinnon","ScanSource","SolarEdge Technologies","Hawaiian Holdings","iRobot","Anika","Progress Software","Bruker","Strategic Education","NuVasive","Raven Industries","Trimble","Workday","Natus Medical Incorporated","NETGEAR","Myriad Genetics","Diodes Incorporated","ON Semiconductor","Five Below","Churchill Downs","Papa John's International","Take-Two Interactive Software","Werner Enterprises","Allegiant Travel","Red Robin Gourmet Burgers","Cirrus Logic","Wingstop","Fox","Fox","The Walt Disney","Kcell Joint Stock","Joint Stock","Kazakhtelecom","Livent","TriNet Group","Trex","Domtar","UniFirst","United States Cellular","Watts Water Technologies","Simpson Manufacturing","Standex","Sensient Technologies","Teledyne Technologies","TransUnion","The Scotts Miracle-Gro","Asbury Automotive Group","AAR corp","Autoliv","ASGN","The Brink's","Belden","Berry Global","Armstrong World","American States Water","Badger Meter","Celanese","Deluxe","Emergent BioSolutions","FTI Consulting","H.B. Fuller","Greenbrier","Green Dot","Greif","Graham Holdings","Globus Medical","Generac Holdings","Group 1 Automotive","Crane","Carpenter","Granite Construction","Hexcel","Kirby","Lithia Motors","Movado","MSC Industrial","Materion","NewMarket","New Jersey Resources","ServiceNow","Insperity","Nu Skin","MAXIMUS","Proto Labs","Sturm, Ruger","Rogers","Rollins","The Boston Beer","Spirit Airlines","REX American Resources","Repligen","SINA","The Providence Service","Merit Medical Systems","Nexstar Media","OSI Systems","Paylocity Holding","Pegasystems","Power Integrations","Insight Enterprises","MTS Systems","Manhattan Associates","ManTech","Magellan Health","InterDigital","Inter Parfums","John B. Sanfilippo","Johnson Outdoors","Kaiser Aluminum","Hub Group","Calavo Growers","Chart Industries","Ensign Group","Enanta","Erie Indemnity","ExlService","FARO","Cognex","Copart","Cal-Maine Foods","Barrett Business Services","BJ's Restaurants","Atrion","American Woodmark","Advanced Energy","Semtech","Grand Canyon Education","Acacia","QAD","Gentherm","Woodward","Westinghouse Air Brake","Apartment Investment & Management","Covetrus","AGCO","Allison Transmission","Arista Networks","A. O. Smith","Ashland Global Holdings","Booz Allen","Brunswick","Big Lots","Bio-Rad","Broadridge","Carter's","Carlisle Companies Incorporated","Dillard's","Deckers","Dycom","EPAM","Continental Resources","Eagle Materials","Guidewire Software","Hyatt Hotels","HollyFrontier","Huntington Ingalls Industries","Ingredion","Jones Lang","Keysight","Lear corporation","FactSet Research Systems","FleetCor","Lennox International","Las Vegas Sands","ManpowerGroup","MSCI","Vail Resorts","Oshkosh","Paycom Software","Polaris","Packaging of America","NVR","Owens Corning","RPM International","Reliance Steel","ResMed","Shake Shack","SYNNEX","Spirit AeroSystems","Tyler Technologies","Veeva Systems","Westlake Chemical","Williams-Sonoma","Watsco","XPO Logistics","Teleflex Incorporated","Thor Industries","Texas Roadhouse","Zebra Technologies","Ubiquiti","United Therapeutics","SS&C Technologies Holdings","Silicon Laboratories","RealPage","Sanderson Farms","SEI Investments","Old Dominion Freight Line","Universal Display","Dave & Buster's","Children's Place","Pool","PRA Health Sciences","Qualys","Maxim Integrated Products","Nordson","MercadoLibre","The Middleby","MarketAxesss","lululemon","Fortinet","Lincoln Electric","IPG Photonics","j2 Global","Jack Henry","HealthEquity","Integra LifeSciences Holdings","Inogen","Healthcare Services Group","Diamondback Energy","Columbia Sportswear","Etsy","Casey's General Stores","Cracker Barrel","Cadence Design","Blackbaud","AeroVironment","AMC Networks","Amedisys","Cigna","Dominion Energy","Equitrans Midstream","WestRock","Linde","Resideo Technologies","Energy Transfer LP","Perspecta","Wyndham Hotels","ChampionX","Splunk","Broadcom","Howmet Aerospace","Palo Alto","Lennar","Entercom Communications","Bayerische Motoren Werke Aktiengesellschaft","China Biologic Products","Global Payments","Mid-America Apartment Communities","TechnipFMC","LKQ","Globe Life","Synopsys","Johnson Controls International","Raymond James Financial","Digital Realty","S&P Global","Brighthouse Financial","Alexandria Real Estate Equities","Huntington Bancshares Incorporated","Foot Locker","Arthur J. Gallagher","TransDigm","Albemarle","Ulta Beauty","IDEXX Laboratories","Fortune Brands Home & Security","Ameren","Regency Centers","Everest Re,","Charter Communications","Consolidated Edison","Vornado Realty Trust","Coty","Alliant Energy","Centene","Acuity Brands","Cooper Companies","Incyte","Mettler-Toledo International","IHS Markit","Gartner","Under Armour","Goldman Sachs","Advanced Micro Devices","Hologic","Willis Towers Watson","DXC Technology","Hilton Worldwide","Fortive","ANSYS","Unum Group","Align Technology","Alaska Air Group","Baker Hughes","Alcoa","Urban Outfitters","Hanesbrands","AutoZone","Under Armour","Constellation Brands","DENTSPLY SIRONA","Signet Jewelers","CarMax","Newell Brands","Aptiv","Xilinx","V.F.","Marathon Petroleum","Northern Trust","Western Digital","Cimarex Energy","Alexion Pharmaceuticals","U.S. Bancorp","Darden Restaurants","Marsh & McLennan","Brown-Forman","Alliance Data Systems","CMS Energy","State Street","Host Hotels","Pitney Bowes","Trane Technologies","FLIR Systems","Humana","People's United Financial","Nordstrom","Mallinckrodt","Booking Holdings","Equinix","Leggett & Platt","Genuine Parts","Expedia Group","Kimco Realty","Regions Financial","Endo International","Macy's","NextEra Energy","Synchrony Financial","Applied Materials","Cardinal Health","The Western Union","Keurig Dr Pepper","Murphy Oil","Kraft Heinz","NortonLifeLock","Vertex Pharmaceuticals","BorgWarner","T. Rowe Price Group","The Gap","salesforce","TripAdvisor","Boston Properties","Discovery","National Oilwell Varco",
"Helmerich & Payne","Anthem","Henry Schein","Cognizant Technology","Air Products & Chemicals","Costco Wholesale","Southern company","Teradata","Royal Caribbean Cruises","Ralph Lauren","Essex Property Trust","DTE Energy","Ventas","Prudential Financial","The PNC Financial Services","Texas Instruments","Discovery Communication","Weyerhaeuser","Chubb","Chipotle Mexican Grill","Skyworks Solutions","Affiliated Managers","Citizens Financial","Moody's","ONEOK","Iron Mountain","Electronic Arts","Zions Bancorporation","Fiserv","Ecolab","The Mosaic","Entergy","Intuitive Surgical","F5 Networks","Qorvo","Monster Beverage","International Flavors","Hartford Financial","SL Green Realty","Becton,Dickinson","Sealed Air","Akamai","VeriSign","The Interpublic Group of Companies","The Sherwin-Williams","Kellogg","Garmin","Best Buy","DaVita","Public Service Enterprise Group Incorporated","Comcast","Amphenol","Lowe's","Waters","O'Reilly Automotive","Advance Auto Parts","Welltower","Church & Dwight","The Kroger","Eversource Energy","Range Resources","Prologis","Analog Devices","Corning","Hewlett Packard Enterprise","Regeneron","Avery Dennison","Fidelity National Information Services","Seagate Technology Public","KeyCorp","Ross Stores","Motorola Solutions","Public Storage","PulteGroup","Cerner","Franklin Resources","International Paper","AES","Whirlpool","Harley-Davidson","Capital One Financial","Intercontinental Exchange","Microchip Technology","Juniper Networks","Bank of New York Mellon","CenturyLink","WEC Energy Group","Loews","Marriott","McCormick","CF Industries Holdings","Horton","H&R Block","Adobe","Discover Financial","Colgate-Palmolive","Southwestern Energy","American Tower","Cincinnati","Smucker","The TJX","TEGNA","FMC","Eli Lilly","Wyndham Destinations","EQT","Truist Financial","Carnival","Zoetis","NetApp","UDR","L3Harris","Assurant","Fifth Third Bancorp","Walgreens","Quest Diagnostics","LyondellBasell","Zimmer Biomet","Healthpeak Properties","Wynn Resorts","Invesco","FirstEnergy","Nasdaq OMX","Agilent Technologies","Berkshire","Mohawk","Hasbro","Autodesk","Illumina","HCA Healthcare","Tractor Supply","Jefferies","Baxter","Citrix","Edwards Lifesciences","The Progressive","L Brands","Hormel Foods","PVH","PG&E","Stryker","Comerica Incorporated","Sysco","Realty Income","Capri","General Mills","Conagra Brands","Varian Medical Systems","The Travelers Companies","Abbott","American Airlines Group","Transocean","CBRE Group","Crown Castle","Bed Bath & Beyond","Aflac","PerkinElmer","Sempra Energy","Principal Financial Group","Universal Health Services","Ameriprise Financial","CVS Health","Kimberly-Clark","Yum!","Thermo Fisher","Campbell Soup","TE Connectivity","Extra Space Storage","The Goodyear","Ball Corporation","AutoNation","Tyson Foods","Vulcan Materials","Tapestry","PPL Corporation","Activision Blizzard","The Clorox","Allegion","Archer-Daniels-Midland","Estee Lauder","Intuit","Macerich","Omnicom","Nucor","Cabot","Eastman Chemical","McKesson","Molson Coors","Mattel","M&T Bank","KLA","Automatic Data Processing","Martin Marietta Materials","Patterson","Navient","Laboratory of America Holdings","Simon Property","PPG Industries","Lam Research","CenterPoint Energy","The Allstate","AvalonBay Communities","Xcel Energy","Edison International","Lennar","Dollar General","Schlumberger","PepsiCo","Bristol-Myers Squibb","BlackRock","Fluor","Eaton Corporation","AMETEK","UnitedHealth Group","Fastenal","Deere","Parker-Hannifin","NVIDIA","Cummins","Roper Technologies","PACCAR Inc","Danaher","Hess","FedEx","The Home Depot","Nielsen Holdings","Lockheed Martin","Union Pacific","Dollar Tree","Southwest Airlines","C.H. Robinson","NIKE","Citigroup","Amgen","Kinder Morgan","Waste Management","Devon Energy","3M Company","Illinois Tool Works","Medtronic","Altria","Raytheon Technologies","Robert Half International","Honeywell","Norfolk Southern","Occidental Petroleum","W.W. Grainger","Pioneer Natural Resources","Textron","Snap-on Incorporated","Mastercard Incorporated","United Airlines Holdings","Halliburton","United Parcel Service","Dover","Expeditors International of Washington","American Express","Phillips 66","United Rentals","Flowserve","Verisk Analytics","Equifax","Rockwell Automation","Jacobs Engineering Group","Kansas City Southern","Quanta Services","Biogen","Stanley Black","Masco","Mondelez International","Ryder System","Wells Fargo","The Williams Companies","Freeport-McMoRan","Marathon Oil","Concho Resources","Republic Services","JPMorgan Chase","Cintas","ConocoPhillips","Stericycle","Accenture","The Charles Schwab","J.B. Hunt Transport Services","Merck","The Hershey","Northrop Grumman","Apache","EOG Resources","Xylem","General Motors","Emerson Electric","American International Group","Oracle","Boston Scientific","General Dynamics","JSC BAST","Aktobe Metalware","Cleveland-Cliffs","Ferrari","Alphabet","PayPal","Tiffany","Microsoft","Delta Air Lines","Cisco","GILEAD","ViacomCBS","CME Group","Valero Energy","Exelon","International Business Machines","Walmart","McDonald's","Pfizer","QUALCOMM","First Solar","Johnson & Johnson","Micron Technology","MetLife","Chevron","Ford Motor","Apple","Exxon Mobil","Twitter","Netflix","Visa","NRG Energy","AbbVie","BOEING","Morgan Stanley","AT&T","Philip Morris","Bank of America","Intel Corporation","Verizon Communications","Amazon.com","Caterpillar","General Electric","The Procter & Gamble","Tesla","eBay","Starbucks","Facebook","Newmont"];
// $companies = [];

// for ($i = 0; $i < 6; $i++) {
  $start_time =  microtime(true);

  $result = start($words, $companies); 
 
  // dump($result);
  if (!$result['error']){ 

    if (count($result['result']) > 0) {
        
      // Проходимяся по сайтам
      foreach ($result['result'] as $site => $cur_site_news){ 

        echo $site . '<br>';

        if(count($cur_site_news) > 0) {
          // Проходимся по новостям на конкретном сайте
          foreach ($cur_site_news as  $one_news){ 

            // Проверяем есть ли такая новость в БД
            // Ответ преобразуем в boolean
            $is_news_exist = filter_var(is_news_exist_bd($one_news), FILTER_VALIDATE_BOOLEAN, ['flags'=>FILTER_NULL_ON_FAILURE]);
 
            // Отсеиваем уже добавленный\отправленные новости
            if ($is_news_exist == "true") {

              echo "Такая новость уже есть - ".$one_news['title'] ."<br>";

            }else{
              echo "Такой новости нет - ".$one_news['title'] ."<br>"; 

              if ($one_news != null) {
                // Добавляем новость в бд
                add_news_bd($one_news);
                
                // Проверим на совпадение ключа с КЛЮЧЕВЫМИ СЛОВАМИ
                $inter_mas = array_intersect($words, $one_news['keywords']);

                // Если найдено по "словам" то отправляем в общий чат, иначе в обычный
                if(count($inter_mas) > 0) {
                  array_push($new_news_words, $one_news); 
                }else {
                  array_push($new_news_companies, $one_news); 
                } 
              }
            } 

          } //foreach
        } //if
      } //foreach
 

      // Отправляем в группу по КОМПАНИЯМ только новые новости
      if(!empty($new_news_companies) && count($new_news_companies) > 0){
        // переводим новости
        // $new_news_companies = translate_news($new_news_companies);
        

        // Отправка в телеграм
        $t_bot->send_message($t_bot->create_message($new_news_companies), 445743340);
        $new_news_companies = [];
      } 

      // Отправляем в группу по СЛОВАМ ттолько новые новости
      if(!empty($new_news_words) && count($new_news_words) > 0 ){
        // переводим новости
        // $new_news_words = translate_news($new_news_words);

        // Отправка в телеграм
        $t_bot->send_message($t_bot->create_message($new_news_words), 445743340);
        $new_news_words = [];
      } 
      
    }
    else  {
      echo "В данный момент нет подходящих новостей" . PHP_EOL;
      // dump($result);
    }
  }
  else{
    echo $result['message'] . PHP_EOL;
  } 
  echo "<br> Парсинг занял: " . round(microtime(true) - $start_time, 4) . " сек.<br>";
//   sleep(10);
// }
 
file_put_contents('log.txt', 'Программа зевершена ' . date('"Y-m-d H:i:s"') . '<br><br>', FILE_APPEND);



function start($words, $companies){

  // Стартовые данные 
  // Позже будут в БД
  $urls = [
    'globenewswire.com'    => ['url' => 'https://www.globenewswire.com/Index','type' => 'html'],
    'prnewswire.com'       => ['url' => 'https://www.prnewswire.com/news-releases/news-releases-list/','type' => 'html'],
    'businesswire.com'     => ['url' => 'https://www.businesswire.com/portal/site/home/news/','type' =>  'html'],
    'finance.yahoo.com'    => ['url' => 'https://finance.yahoo.com/news/','type' =>  'html'],
    'barrons.com'          => ['url' => 'https://www.barrons.com/topics/markets','type' =>  'html'],
    'streetinsider.com'    => ['url' => 'https://www.streetinsider.com/dr/ajax.php?a=basic_latest_news&type=top','type' => 'json'],
    'seekingalpha.com'     => ['url' => 'https://seekingalpha.com/market-news/all','type' => 'html'],
    'fda.gov'              => ['url' => 'https://www.fda.gov/news-events/fda-newsroom/press-announcements','type' =>  'html'],
    'mobile.reuters.com'   => ['url' => 'https://mobile.reuters.com/finance/markets','type' =>  'html'],
    'wsj.com'              => ['url' => 'https://www.wsj.com/news/latest-headlines?mod=wsjheader','type' =>  'html'],
    'thefly.com'           => ['url' => 'https://thefly.com/news.php','type' =>  'html'],

    // 'bloomberg.com'     => ['url' => 'https://www.bloomberg.com/deals','type' =>  'html'], // Вылезает капча
    // 'cnbc.com'          => ['url' => 'https://www.cnbc.com/markets/','type' =>  'html'], // json - защищен, а сайт не парсится (ощибка сервера)
     
  
    /*
    
    https://www.docwirenews.com
    https://www.channelnewsasia.com/news/business
    */
    
  ];
  
  $keywords = array_merge($words, $companies);
  // ------------------------- 

  $result_mas = ['message' =>'Данные для парсинга не были получены ', 'error' => true, 'result' => []];

  // Проходимся по всем сайтам
  foreach ($urls as $site => $url){
    $html = null;
    $json = null;
    
    echo $site. "<br>";

    // Выбираем параметры и способ запроса
    if ($site == "businesswire.com") {
      $opts = array('http' => array(
        "authority" => "cdn.cookielaw.org",
        "method"=>  "GET",
        "path" => "/consent/a2007379-c22b-41e8-8743-1bbfd2cbb24a/a2007379-c22b-41e8-8743-1bbfd2cbb24a.json",
        "scheme" => "https",
        "method" => "GET",
        "header" => 'accept:*/*'
        ."accept-encoding: gzip, deflate, br"
        ."accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7"
        ."cache-control: no-cache"
        ."dnt: 1"
        ."origin: https://www.businesswire.com"
        ."pragma: no-cache"
        ."referer: https://www.businesswire.com/portal/site/home/news/"
        ."sec-fetch-dest: empty"
        ."sec-fetch-mode: cors"
        ."sec-fetch-site: cross-site"
        ."user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36"
      ));
        
    $context = stream_context_create($opts); 
    $html = file_get_contents($url['url'],false,$context);
    }
    elseif ($url['type'] == 'json'){
      $json =  file_get_contents_curl($url['url']);
    } 
    else {
      $html = file_get_contents($url['url']);
    }  

    $parser = new siteParser($site, $url, $keywords);
    $tags = $parser->set_tags($site);


    // Проверяем заданы ли теги для этого сайта
    if($tags != null) {

      // Проверяем тип сайта html или JSON
      if ($html !== null && $url['type'] == 'html') { 

        $document_html = phpQuery::newDocument($html); 
        
        $parse_result = $parser->parse_HTML($document_html, $tags); 
        if(!$parse_result['error']){

          echo 'Сайт спарсен успешно <br><br>';

          $result_mas['message'] = $parse_result['message'];
          $result_mas['error'] = $parse_result['error'];
          $result_mas['result'][$site] = $parse_result['result']; 

          // dump($result_mas['result'][$site]);
        }
        else{
          echo 'При парсенге произошла ошибка: '. $parse_result['message'];
        }
        
      }
      elseif ($json !== null  && $url['type'] == 'json'){ 
        $parse_result = $parser->parse_JSON($json, $tags);
        if(!$parse_result['error']){

          echo 'Сайт спарсен успешно <br>';

          $result_mas['message'] = $parse_result['message'];
          $result_mas['error'] = $parse_result['error'];
          $result_mas['result'][$site] = $parse_result['result']; 
        }
        else{
          echo 'При парсенге произошла ошибка: '. $parse_result['message'];
        }
      }
    }
    else{
      echo "Ошибка! Нет данных (тегов) для парсинга сайта " . $site . "<br>";
    }
    
  } 
    
  return $result_mas;

}// start()


 

 

?>