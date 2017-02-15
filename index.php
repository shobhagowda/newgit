<?php 

    function create_lead($lead_name,$lead_tel,$lead_email,$message) 
{
    

    $lead_message = preg_replace( "/\r|\n/", " ", $message);
    // Give below the numbers to recieve SMS
    $tel_admins = "8089908879,8861864836,8884765615";





    // todo: save to db from admin page
    $project_name = "PROJECT NAME"; 
    $project_id = "PROJECT ID";

    $msg_start = rawurlencode('Congrats New Lead Has Arrived');
    $msg_end = rawurlencode('Team BMH');

    $msg_part_1 = rawurlencode('via BookMyHomes.com');
    $msg_part_2 = rawurlencode('Name: '.$lead_name.',');
    $msg_part_3 = rawurlencode('Mob: '. $lead_tel.'.');
    $msg_part_4 = rawurlencode('Email: '.$lead_email.'.');
 
    $msg_body = '%0a'.$msg_part_1.'%0a'.$msg_part_2.'%0a'.$msg_part_3.'%0a'.$msg_part_4.'%0a';

    $message = $msg_start.$msg_body.$msg_end;

    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => "http://msg.msgclub.net/rest/services/sendSMS/sendGroupSms?AUTH_KEY=91dea276c4d175db8589bd9796ca2fa&message=".$message."&senderId=BMHLDS&routeId=1&mobileNos=".$tel_admins."&smsContentType=english",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);


   $espo_username = "bmh_bot";
   $espo_password = "yeahimbot";
         
    //$lead_email = "onerinas@gmail.com";

    $data_string = '{"assignedUserId":"55e9874f92a06a70d","assignedUserName":"BMH Bot","firstName":"'.$lead_name.'","lastName":"","status":"New Lead","city":"Bangalore","linkedProject":"","teamsIds":["55a8aeb1d5b052063"],"teamsNames":{"55a8aeb1d5b052063":"Admin"},"salutationName":"Mr.","phoneNumberData":[{"phoneNumber":"'.$lead_tel.'","primary":true,"type":"Mobile"}],"phoneNumber":"'.$lead_tel.'","emailAddressData":[{"emailAddress":"'.$lead_email.'","primary":true,"optOut":false,"invalid":false}],"emailAddress":"'.$lead_email.'","projectNameName":"'.$project_name.'","projectNameId":"'.$project_id.'","source":"Web Site","doNotCall":false,"addressPostalCode":"","addressStreet":"","addressState":"","addressCity":"","addressCountry":"","description":"'.$lead_message.'"}';                                                                                   
    //print_r($data_string);
    //echo "<hr>";                                                                                                                     
    $process = curl_init('http://bookmyhomes.com/espocrmv2/api/v1/Lead');    


    curl_setopt($process, CURLOPT_USERPWD, $espo_username . ":" . $espo_password);                                                                    
    curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($process, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($process, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   
                                                                                                                           
      $result = curl_exec($process);
      $err = curl_error($process);
      curl_close($process);
 
}



?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
<link rel="dns-prefetch" href="//www.google-analytics.com">
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book My Homes</title>
    <link rel="stylesheet" href="css/foundation.min.css" />
    <link rel="stylesheet" href="css/app.css" />
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" >


  <link rel="shortcut icon" href="favicon.ico" />     
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','analytics.min.js','ga');

  ga('create', 'UA-75383014-11', 'auto');
  ga('send', 'pageview');

</script> 
  </head>
  <body>


    <div id="header" class="row">

      <div class="large-2 columns">
       <a href="/" ><img id="logo" src="img/bookmyhomes-logo.jpg" alt="BookMyHomes"></a> 
      </div>
     
    </div>


    <div class="row">
      <div id="banner" class="medium-8 columns">
        <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;">

          <ul class="orbit-container">
            <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
            <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
            <li class="is-active orbit-slide">
              <img class="orbit-image" src="img/brigadeorchards-banner.jpg" alt="brigadeorchards-banner">
              <figcaption class="orbit-caption">Brigade Orchards</figcaption>
            </li>
            <li class="orbit-slide">
              <img class="orbit-image" src="img/salarpuriaaltana-banner.jpg" alt="salarpuriaaltana-banner">
              <figcaption class="orbit-caption">Salarpuria Altana</figcaption>
            </li>
            <li class="orbit-slide">
              <img class="orbit-image" src="img/puravankara-cityofgold-banner.jpg" alt="puravankara-cityofgold-banner">
              <figcaption class="orbit-caption">Puravankara City Of Gold</figcaption>
            </li>
            <li class="orbit-slide">
              <img class="orbit-image" src="img/purvacoronationsquare-banner.jpg" alt="purvacoronationsquare-banner">
              <figcaption class="orbit-caption">Purva Coronation Square JP Nagar 7th Phase</figcaption>
            </li>
          </ul>
<!--           <nav class="orbit-bullets">
            <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
            <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
            <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
            <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
          </nav> -->
        </div>
      <div class="row">
        <div class="large-12 columns">

            <div class="callout secondary">
              <div class="row">
                <div class="large-6 columns">
                 <a href="tel:<?php echo contact(); ?>" class="contact expanded primary button"><b><i class="fi-telephone "></i> Call</b></a> 

                 <?php 
                  function contact(){
                    $contacts = array(
                      '1' => '08861864836',
                      '2' => '08884765615'
                       );
                    return $contacts[rand(1,2)];
                  }

                 ?> 
                </div>
                <div class="large-6 columns">
                   <a href="javascript:javascript:$zopim.livechat.window.show();" class="contact expanded secondary button"><b><i class="fi-comment"></i> CHAT</b></a>
                </div>
              </div>
            </div>

<!-- content goes here -->
        
      
          <ul class="tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#who-we-are" aria-selected="true">Who we are?</a></li>
            <li class="tabs-title"><a href="#core-strength">Core Strength</a></li>
            <li class="tabs-title"><a href="#projects">Our Projects</a></li>
            <li class="tabs-title"><a href="#contact-us">Contact Us</a></li>
          </ul>

          <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="who-we-are">
              <h3>BookMyHomes Estates</h3>
              
                <p>Bangalore has been the fastest-growing city of India since the past few decades. IT has been the major growth driver and is responsible for aggressive real estate development in the city. Being the IT hub of India, Bangalore has a multi-cultural population with good social infrastructure, excellent educational institutes and constantly upgrading physical infrastructure. Currently, the most promising residential micro-markets are Outer Ring Road (ORR), Sarjapur Road, Whitefield and North Bangalore.</p>
                <p><b>Luxury Residential:</b>
                Bangalore is the third-largest hub for High Net worth Individuals (HNIs). It is estimated to be home to over 10,000 individual dollar millionaires. Bangalore has a large base of expatriates who live and work in the city. The residents are well travelled, cultured and have sophisticated tastes.</p>
                <p>There has been increased demand for high-end residential apartments in the city, particularly in the Central Business District (CBD), Secondary Business District (SBD), Whitefield, North Bangalore and Outer Ring Road sub-markets. We expect consumer demand for high-end residential projects in these sub-markets to be steady over the short term.
                <p>Bangalore is one of the most promising markets for villa projects in India. Villa and row house developments are most active in the North Bangalore, ORR, Sarjapur Road and Whitefield micro-markets. High-end residential property buyers in Bangalore are very sensitive in terms of amenities, product quality and unit sizes.</p>
                <p><b>Mid-Income Housings:</b>
                This segment is mainly driven by individuals working in the IT and ITES industry. The main driving factors for this segment are social infrastructure, proximity to workplaces, good physical infrastructure and access to medical and educational facilities.</p>
                <p>Because of these reasons, micro-markets such as Whitefield, the ORR IT corridor, Electronic City and few areas in North Bangalore have witnessed a steady demand from the mid-income segment.</p>
                <p><b>Affordable Housing: </b>
                The demand from this segment comes from extremely price sensitive buyers – therefore, affordable projects are developed in the suburbs as these areas offer large land parcels at lower acquisition costs. Areas such as Mysore road, Hosur road, Kanakapura road etc. have witnessed high demand for this segment.  </p> 
                <p>The affordable housing concept has gained ground in Bangalore City, mainly due to a few graded developers like Purvankara, Brigade Group, Shriram Properties, Golden Gate Properties, Ozone Group and Nitesh Estate who are focusing their projects for customer segment.</p>
                <p>In most cases, the housing units are made affordable by reduced unit sizes, compromising on civic amenities and other USPs which were typically provided as differentiators to the competing projects in the micro-market/city.  
                Affordable housing has seen constant demand on the outskirts of Bangalore, in all directions. Availability of large land parcels at lower price points has encouraged these developments. Also, the planned Metro Rail and Peripheral Ring Road have increased the demand on the outskirts of Bangalore.</p>
                <p>VBHC Attibele and Patel Neo Town in the South Bangalore, Provident Welworth and Sovereign Lakefront in North Bangalore, and Provident Sunworth and VBHC Kengeri in West Bangalore are some of the affordable housing projects in the city. The demand for affordable housing in East Bangalore is lower when compared to Bangalore’s other micro-markets.  </p>
                <p>With increased demand, ‘affordable’ housing projects have witnessed an increase in the capital prices and are now priced higher than or similar to mid-income segment projects.</p>
                These projects have also seen substantial rise in capital values because of increased cost of land acquisition and construction. Developers have therefore resorted to redesigning their projects to address the demand of a wider target segment looking at the budget homes category.</p>
                Major national level players and local developers have plans to enter the affordable housing segment of Bangalore. These include Tata Housing, Usha Breco Realty, Godrej Properties, Ashoka Group, Jannaadhar Construction, CSC Builders, Brigade Group, etc. </p>
                <p><b>Overall Demand Scenario: </b>
                The Bangalore market saw absorption of 6,519 units in 2Q13 against 6,689 units in 1Q13. Unsold stock in 2Q13 totalled 50,184 units in 2Q13 as compared to 46,823 in 1Q13, reflecting a vacancy rate of 53.4%, down from 54.2% in 1Q13.
                Supply: A total of 21 residential projects were launched across Bangalore in 2Q13, offering 9,889 units against 10,009 units in 1Q13. Meanwhile, eight residential projects comprising 2,319 units in various sub-markets were withdrawn from active stock as they were completely sold out.</p>
                <p>The major projects launched in 2Q13 included Prestige Sunrise, Prestige Ivy Terraces, Shriram Sameeksha, Sobha Santorini and Brigade Begonia. </p>
                <p><b>Central (CBD) & Off Central (SBD):</b> Low supply and high demand. Due to low availability of large land parcels and high capital values, these micro-markets have seen a limited supply of residential developments. These markets have very good social and physical infrastructure.</p>
                <p>Nitesh Park Avenue, Prestige Kingfisher Towers, Westcourt Cityview, ETA Beau Monde, 77 Degrees East, Sobha Indraprastha and Prestige Edwardian are some of the high-end projects in these micro-markets. </p>
                
                <p><b>North Bangalore</b>The demand for high-end residential units remains high in the North Bangalore region. Residential real estate activity in North Bangalore has gained traction post the commencement of the Bangalore International Airport. The projects located around Hebbal, Bellary Road and surrounding areas are in the luxury segment. North Bangalore is assured to be the next economic centre of Bangalore.</p>
                <p>Proximity to the International Airport and planned social and the physical infrastructure in the North have boosted development in the area. Embassy Lake Terraces, RMZ Latitude, Karle Zenith, Equinox, Embassy Boulevard are some of the high-end projects in the North Bangalore.</p>
                <p><b>South Bangalore: </b>
                The demand for high-end residential developments is low in the South. The housing requirement in this area increased after Electronic City established itself as an IT Hub in this micro-market. However, it did not attract premium residential developments due to poor urban and social infrastructure.</p>
                <p><b>East Bangalore: </b>
                Whitefield as a micro-market has developed into a self-sustaining area. Along with being an IT destination, this area has good social infrastructure and developing physical infrastructure. Hence, the demand for luxury residential developments remains high. Adarsh Palm Meadows, Prestige White Meadows, Chaithanya Sharan, Windmills of Your Mind are some of the luxury projects in this market.</p>
                <p><b>West Bangalore:</b>  
                This micro-market has not been successful in attracting many real estate developers as it fails on the count of good social infrastructure. It is mainly dominated by industrial developments and has seen hardly any developments in high-end residential developments. </p>
                <h3>Demand Drivers:</h3>
                <p>
                <b>North Bangalore:</b> Proximity to the International Airport, planned infrastructure such as the Elevated Expressway (Bellary Road), High Speed Rail Link, Bangalore Metro Rail, etc. have been the major growth drivers for residential development in North Bangalore. Also, the Government is aggressively promoting this area for future economic activities. The planned Information Technology Investment Region (ITIR) near Devanhalli, Aerospace SEZ planned near the International Airport and the proposed Devanhalli Business Park are the key drivers for residential development in North Bangalore. Some of the prime developments in North Bangalore in the mid-segment residential category are Prestige Misty Waters, Hiranandani Glen Gate, Brigade Altamont, Mantri Webcity and Sobha City.</p>
                <p><b>South Bangalore:</b> South Bangalore is close to major work centres along the ORR and is primarily classified as an upper middle-class residential catchment. It has potential for further augmentation of existing physical and social infrastructure. Over the past few years, the Southern suburbs have witnessed a high percentage of appreciation on investments. Amongst the prime residential developments in the Southern suburbs of Bangalore, projects that can be listed are Salarpuria Greenage, SNN Raj Lakeview, Purva Highlands and Sobha Forest View.</p>
                <p><b>East Bangalore:</b> Eastern Bangalore is characterized by major work centres like Whitefield, the EPIP Zone which has escalated the development of residential apartments over the past few years. Many mid-scale residential projects like Brigade Cosmopolis, Brigade Lakefront, Sobha Habitech and UKN Belvista have been launched in this area. These areas are self-sufficient in terms of social and physical infrastructure as well, which is of prime importance for residential development.</p>
                <p><b>West Bangalore:</b> West Bangalore is characterized by a low social profile and industrial surroundings. Also, being located away from the major IT-ITES corridors, it shows less potential for real estate growth. Although it has high availability of land for real estate development, the demand is substantially low in this part of Bangalore. Further development of the Metro in the near future might boost the development of mid-segment residential apartments in this area. At present, one of the prominent residential projects in this area is Purva Sunflower.</p>
                <p><b>Factors Influencing Appreciation: </b>
                The following are the factors influencing the capital appreciation and rental potential in Bangalore: <br> 
                Growth in the IT Industry and a rapidly increasing number of High Net-Worth Individuals, and movement of expatriates.
                The proposed infrastructure by the Government (Peripheral Ring Road, Metro Rail, Signal Free ORR, High Speed Rail Link, Mono Rail, Elevated Expressway).</p>
                <p>The proposed SEZ and IT parks in North Bangalore. (ITIR in Devanhalli, Aerospace SEZ, Devanhalli Business Park, Airport city)</p>


              </p>
            </div>
            <div class="tabs-panel" id="core-strength">
              <h3>BookMyHomes Estates</h3>
              <p><b>Local knowledge </b>
              It is incredibly important for the person selling a home to have recent sales experience and success at selling homes in the area. Someone new in town or who has never sold a home in a particular part of town is, in many ways, a beginner. Sellers have a right to pick a winner so start things out right by making sure you’re the best man, or woman, for the job. A top producing real estate agent appreciates and utilizes the nuances that make a specific community’s housing market and pricing strategy unique. Success comes from identifying and developing a focus or niche in the local real estate market that allows you to distinguish yourself from the competition.s</p>
              <p><b>Organized with attention to detail</b>
              A real estate agent that is organized and likes to work with attention to detail is the one that is most likely to sell a home. This is especially true in a hard-to-sell market. Great agents know the tiniest changes sellers can make to improve the sale-ability of their home. They are creative with their MLS listings and they take the best photographs of each home. They return client calls promptly and make every appointment on time. Do you enjoy coming up with creative solutions to problems or issues? Many successful real estate agents know how to properly showcase a house to make it more marketable and develop creative MLS listings to attract the right buyers.s</p>
              <p><b>Connections and representation</b>
              The top agents come to a home with a prospective buyers list. They also are working with a well known realty agency. They know other realtors in the area, too, and are willing to work with others if that sells the home faster. Successful real estate agents have a vast network of contacts within the market they serve. This list of connections should include other real estate agents and brokers, potential buyers and sellers, and all the other players in the real estate industry, such as appraisers, home inspectors, and mortgage loan officers.</p>
              <p><b>Tenacity</b>
              Sellers want an agent that is tenacious. They follow up quickly after every time the home is shown. They appear to work hard and they rarely give up. Being a top producing real estate agent requires a great work ethic. You must have the tenacity to pursue every lead and the hustle to aggressively market your clients’ properties in order to have success. It’s not just about putting in a lot of time—it’s about working smart, putting in the right amount of time, and doing whatever is necessary to close the deal.</p>
              <p><b>Aggressive yet polite attitude</b>
              The best realtor is not afraid to speak up. He or she should be just as promotional about the seller’s home as if it was their own. By being aggressive, the realtor is working hard to put the home in the forefront of the local market. Paying close attention to the details is imperative for your real estate career. A complete real estate agent is attentive to the unique needs of their individual clients. If you are organized, follow up with leads, communicate well, and pay attention to the needs of your clients, you will close more deals.</p>
              <p><b>Flair and good grooming</b>
              Sellers have worked hard to prepare their homes for showing. They want, and need, a realtor that puts their best foot forward. An agent with flair exudes confidence and makes prospective buyers feel at ease. This way, prospective buyers get the impression that his agent would not even list a home that was not an excellent buy. Having a desire to control your own professional destiny and be your own boss is a trait shared by top real estate professionals. To be successful in real estate requires a high degree of self-motivation, drive, and smart decision making.</p>
              <p><b>Knowledge of technology</b>
              An agent that can use technology with ease is going to be more up-to-date on the market in the area. They will also be more likely to be an organized person who has their act together. This is the type of person sellers want helping to sell their homes. Staying up-to-date on the latest topics in real estate and in the local market will allow you to service clients more effectively. Continuing education and professional development are doors to opportunity that you can utilize to expand your business options and stay at the forefront of the real estate field.</p>
              <p><b>Honesty</b>
              Sellers need an honest agent, one that will tell them like it is, even if they’re not the easiest to hear. This type of person will lay out exactly what the seller can expect, from sale price to timing and more. In the end, honesty will save sellers lots of worry. Your professional reputation is crucial to a long and successful career in real estate. Becoming a member of the National Association of REALTORS® is one way to show you practice high ethical standards. To become a member, you must pledge to a strict Code of Ethics and Standards of Practice.</p>
              <p><b>Hardworking</b>
              A realtor should appear to be tireless and should work on the sale of each home as if it was the most important thing in their life. A good real estate agent doesn’t just sell properties—they sell themselves. It’s important to show your real personality. People will respond to you if you have a great attitude, are personable and honest, have confidence in your abilities, and get a sense of fulfillment by serving others. Having a true interest in houses and architecture can give you an advantage over other brokers and salespersons. If your knowledge and interest level is apparent in conversations, your clients will see that you care about the industry you’re in.</p>

            
            </div>
            <div class="tabs-panel" id="projects">
              <div class="row"><div class="large-12 columns">
                <ul class="projects">
                <li><a target="_blank" href="http://www.adarshpalmacres.contact-us-now.com/">Adarsh Palm Acres </a></li>
                <li><a target="_blank" href="http://www.assetz63degreeeast.contact-us-now.com/">Assetz 63 Degree East</a></li>
                <li><a target="_blank" href="http://www.assetzeastpoint.contact-us-now.com">Assetz East Point</a></li>
                <li><a target="_blank" href="http://www.assetzlifestyle.contact-us-now.com/">Assetz Lifestyle</a></li>
                <li><a target="_blank" href="http://www.assetzcompacthomes.contact-us-now.com/">Assetz Compact Homes</a></li>
                <li><a target="_blank" href="http://www.assetzcosmo.contact-us-now.com/">Assetz Cosmo</a></li>
                <li><a target="_blank" href="http://www.assetzlumos.contact-us-now.com/">Assetz Lumos</a></li>
                <li><a target="_blank" href="http://assetz-marq.contact-us-now.com">Assetz Marq</a></li>
                <li><a target="_blank" href="http://www.bhartiya-city.in/">Bhartiya City</a></li>
                <li><a target="_blank" href="http://bhartiyacity.contact-us-now.com">Bhartiya City Nikoo Homes</a></li>
                <li><a target="_blank" href="http://bhartiyacity-leelaresidences.contact-us-now.com">Bhartiya City Leela Residences</a></li>
                <li><a target="_blank" href="http://www.brigadeatmosphere.contact-us-now.com/">Brigade Atmosphere</a></li>
                <li><a target="_blank" href="http://www.brigadebuenavista.contact-us-now.com/">Brigade Buena Vista</a></li>
                <li><a target="_blank" href="http://www.brigadeexotica.contact-us-now.com/">Brigade Exotica</a></li>
                <li><a target="_blank" href="http://www.brigadelaguna.contact-us-now.com/">Brigade Laguna</a></li>
                <li><a target="_blank" href="http://www.brigadenorthridge.contact-us-now.com/">Brigade Northridge</a></li>
                <li><a target="_blank" href="http://brigade-orchards.contact-us-now.com">Brigade Orchards</a></li>
                <li><a target="_blank" href="http://www.brigade7gardens.contact-us-now.com/">Brigade 7 Gardens</a></li>
                <li><a target="_blank" href="http://www.codenamefiverings.contact-us-now.com">Code Name Five Rings</a></li>                        
                <li><a target="_blank" href="http://www.embassyboulevard.contact-us-now.com">Embassy Boulevard</a></li>
                <li><a target="_blank" href="http://www.embassylaketerraces.contact-us-now.com">Embassy Lake Terraces</a></li>
                <li><a target="_blank" href="http://www.embassypristine.contact-us-now.com">Embassy Pristine</a></li>
                <li><a target="_blank" href="http://www.embassyspringsdevanahalli.bookmyhomes.com">Embassy Springs Devanahalli</a></li>
                <li><a target="_blank" href="http://embassyspringsdevanahalli.com">Embassy Springs Devanahalli</a></li>
                <li><a target="_blank" href="http://www.embassysprings.contact-us-now.com">Embassy Springs</a></li>
                <li><a target="_blank" href="http://fortuna-windflower.contact-us-now.com">Fortuna Windflower</a></li>
                <li><a target="_blank" href="http://gcorp-mahalakshmi.contact-us-now.com">G Corp Mahalakshmi</a></li>
                <li><a target="_blank" href="http://www.gcorpresidences.contact-us-now.com/">G Corp Residences</a></li>
                <li><a target="_blank" href="http://gcorp-the-icon.contact-us-now.com">G Corp The Icon</a></li>
                <li><a target="_blank" href="http://www.gcorptheiconsouth.contact-us-now.com">G Corp The Icon South</a></li>
                <li><a target="_blank" href="http://www.godrej17.contact-us-now.com">Godrej 17</a></li>               
                <li><a target="_blank" href="http://www.godrejavenues.contact-us-now.com/">Godrej Avenues</a></li>
                <li><a target="_blank" href="http://www.godrejeternity.contact-us-now.com">Godrej Eternity</a></li>
                <li><a target="_blank" href="http://www.godrejkanakapura.contact-us-now.com">Godrej Kanakapura</a></li>
                <li><a target="_blank" href="http://www.godrejinfinity.contact-us-now.com">Godrej Infinity</a></li>
                <li><a target="_blank" href="http://www.godrejinfinitykeshavnagar.contact-us-now.com">Godrej Infinity Keshavnagar</a></li>
                <li><a target="_blank" href="http://www.godrejdevanahalli.contact-us-now.com">Godrej Devanahalli</a></li>
                <li><a target="_blank" href="http://www.godrejplatinum.contact-us-now.com">Godrej Platinum</a></li>
                <li><a target="_blank" href="http://www.godrejyelahanka.contact-us-now.com">Godrej Yelahanka</a></li>
                <li><a target="_blank" href="http://www.goyalorchidgreens.contact-us-now.com">Goyal Orchid Greens</a></li>  
                <li><a target="_blank" href="http://www.goyalorchidwhitefield.contact-us-now.com">Goyal Orchid Whitefield</a></li>
                <li><a target="_blank" href="http://www.hiranandani-penrith.contact-us-now.com">Hiranandani Penrith</a></li>
                <li><a target="_blank" href="http://www.hiranandanipenrith.com">Hiranandani Penrith</a></li>
                <li><a target="_blank" href="http://www.hiranandanipenrith.in">Hiranandani Penrith</a></li>
                <li><a target="_blank" href="http://hiranandani-queensgate.contact-us-now.com">Hiranandani Queensgate</a></li>
                <li><a target="_blank" href="http://houseofhiranandani-bannerghatta.contact-us-now.com">House Of Hiranandani Bannerghatta</a></li>
                <li><a target="_blank" href="http://houseofhiranandani-devanahalli.contact-us-now.com">House Of Hiranandani Devanahalli</a></li>
                <li><a target="_blank" href="http://houseofhiranandani-hebbal.contact-us-now.com">House of Hiranandani Hebbal</a></li>
                <li><a target="_blank" href="http://hoysala-ace.contact-us-now.com">Hoysala Ace</a></li>
                <li><a target="_blank" href="http://www.krishnahaven.contact-us-now.com">Krishna Haven</a></li>
                <li><a target="_blank" href="http://www.lnthebbal.com">L&T Hebbal Northstar</a></li>
                <li><a target="_blank" href="http://lnt-raintree-boulevard.bookmyhomes.com/">L&T Realty Raintree Boulevard</a></li>
                <li><a target="_blank" href="http://lnt-raintree-boulevard.contact-us-now.com/">L&T Realty Raintree Boulevard</a></li>
                <li><a target="_blank" href="http://www.legacycelino.contact-us-now.com">Legacy Celino</a></li>
                <li><a target="_blank" href="http://www.legacyestilo.contact-us-now.com">Legacy Estilo</a></li>
                <li><a target="_blank" href="http://www.legacyvivienda.contact-us-now.com">Legacy Vivienda</a></li>
                <li><a target="_blank" href="http://www.mahaveeramaze.contact-us-now.com">Mahaveer Amaze</a></li>
                <li><a target="_blank" href="http://www.mahaveermaple.contact-us-now.com">Mahaveer Maple</a></li>   
                <li><a target="_blank" href="http://mahaveer-palatium.contact-us-now.com">Mahaveer Palatium</a></li>
                <li><a target="_blank" href="http://www.mahaveer-ranches.contact-us-now.com/">Mahaveer Ranches</a></li>
                <li><a target="_blank" href="http://www.mahaveersitara.contact-us-now.com/">Mahaveer Sitara</a></li>
                <li><a target="_blank" href="http://www.mahaveersitara.in/">Mahaveer Sitara</a></li>
                <li><a target="_blank" href="http://www.mahaveercelesse.contact-us-now.com/">Mahaveer Celesse</a></li>
                <li><a target="_blank" href="http://www.mahaveerjasper.contact-us-now.com/">Mahaveer Jasper</a></li>
                <li><a target="_blank" href="http://www.mahaveerjonquil.contact-us-now.com/">Mahaveer Jonquil</a></li>
                <li><a target="_blank" href="http://www.mahaveermeridian.contact-us-now.com/">Mahaveer Meridian</a></li>
                <li><a target="_blank" href="http://www.mahaveerzephyr.contact-us-now.com/">Mahaveer Zephyr</a></li>
                <li><a target="_blank" href="http://mantri-energia.contact-us-now.com">Mantri Energia</a></li>
                <li><a target="_blank" href="http://www.niteshmelbournepark.contact-us-now.com">Nitesh Melbourne Park</a></li>
                <li><a target="_blank" href="http://www.niteshparkavenue.contact-us-now.com">Nitesh Park Avenue</a></li>
                <li><a target="_blank" href="http://ozone-urbana.contact-us-now.com">Ozone Urbana</a></li>
                <li><a target="_blank" href="http://www.peninsulaheights.contact-us-now.com/">Peninsula Heights</a></li>                                            
                <li><a target="_blank" href="http://www.prestigeboulevard.contact-us-now.com/">Prestige Boulevard</a></li>
                <li><a target="_blank" href="http://www.prestige-eden-garden.contact-us-now.com">Prestige Eden Garden</a></li>
                <li><a target="_blank" href="http://www.prestigeelysian.contact-us-now.com/">Prestige Elysian</a></li>
                <li><a target="_blank" href="http://prestige-falconcity.contact-us-now.com">Prestige Falcon City</a></li>
                <li><a target="_blank" href="http://www.prestigefairfield.contact-us-now.com/">Prestige Fairfield</a></li>
                <li><a target="_blank" href="http://www.prestigefernsresidency.contact-us-now.com">Prestige Ferns Residency</a></li>
                <li><a target="_blank" href="http://www.prestigegreengables.contact-us-now.com/">Prestige Green Gables</a></li>
                <li><a target="_blank" href="http://www.prestigegreenmoor.contact-us-now.com/">Prestige Green Moor</a></li>
                <li><a target="_blank" href="http://www.prestigejindal.contact-us-now.com/">Prestige Jindal</a></li>                                                    
                <li><a target="_blank" href="http://www.prestige-kewgardens.contact-us-now.com/">Prestige Kew Gardens</a></li>
                <li><a target="_blank" href="http://www.prestige-lake-ridge.contact-us-now.com/">Prestige Lake Ridge</a></li>
                <li><a target="_blank" href="http://prestige-lakesidehabitat.contact-us-now.com">Prestige Lakeside Habitat</a></li>
                <li><a target="_blank" href="http://www.prestigemistywaters.contact-us-now.com/">Prestige Misty Waters</a></li>
                <li><a target="_blank" href="http://prestige-northpoint.contact-us-now.com">Prestige North Point</a></li>
                <li><a target="_blank" href="http://www.prestigeprimerosehills.contact-us-now.com">Prestige Primerose Hills</a></li>
                <li><a target="_blank" href="http://www.prestigeparksquare.contact-us-now.com">Prestige Park Square</a></li>
                <li><a target="_blank" href="http://www.prestige-song-of-south.com">Prestige Song Of South</a></li>
                <li><a target="_blank" href="http://prestige-templebells.contact-us-now.com">Prestige Temple Bells</a></li>
                <li><a target="_blank" href="http://www.prestigewhitemeadows.contact-us-now.com">Prestige White Meadows</a></li>      
                <li><a target="_blank" href="http://www.prestigewoodside.contact-us-now.com">Prestige Woodside</a></li>
                <li><a target="_blank" href="http://www.prestigesouthwoods.contact-us-now.com/">Prestige South Woods</a></li>
                <li><a target="_blank" href="http://www.providentharmony.contact-us-now.com">Provident Harmony</a></li>
                <li><a target="_blank" href="http://www.providentraysofdawn.contact-us-now.com">Provident Rays of Dawn</a></li>
                <li><a target="_blank" href="http://www.providentrisingcity.contact-us-now.com/">Provident Rising City</a></li>
                <li><a target="_blank" href="http://www.providentsunworth.contact-us-now.com">Provident Sunworth</a></li>                                        
                <li><a target="_blank" href="http://puravankara-cityofgold.contact-us-now.com">Puravankara City Of Gold</a></li>
                <li><a target="_blank" href="http://www.purvacoronationsquare.contact-us-now.com/">Purva Coronation Square</a></li>
                <li><a target="_blank" href="http://www.purvacoronationsquare.co/">Purva Coronation Square</a></li>
                <li><a target="_blank" href="http://www.purvathesoundofwater.contact-us-now.com/">Purva The Sound of Water</a></li>
                <li><a target="_blank" href="http://purva-palm-beach.contact-us-now.com">Purva Palm Beach</a></li>
                <li><a target="_blank" href="http://www.purvaskydale.contact-us-now.com/">Purva Skydale</a></li>
                <li><a target="_blank" href="http://www.purvaskywood.contact-us-now.com/">Purva Skywood</a></li>
                <li><a target="_blank" href="http://www.purvasunflower.contact-us-now.com">Purva Sunflower</a></li>                              
                <li><a target="_blank" href="http://www.rmzlatitude.contact-us-now.com">RMZ Latitude</a></li>
                <li><a target="_blank" href="http://salarpuria-sattva-divinity.contact-us-now.com">Salarpuria Sattva Divinity</a></li>
                <li><a target="_blank" href="http://www.purvathewaves.contact-us-now.com">Purva The Waves</a></li>
                <li><a target="_blank" href="http://www.salarpuriaaltana.contact-us-now.com/">Salarpuria Altana</a></li>
                <li><a target="_blank" href="http://www.salarpuriasattvaaspire.contact-us-now.com/">Salarpuria Sattva Aspire</a></li>
                <li><a target="_blank" href="http://salarpuria-sattva-eastcrest.contact-us-now.com">Salarpuria Sattva East Crest</a></li>             
                <li><a target="_blank" href="http://salarpuriasattva-laurelheights.contact-us-now.com">Salarpuria Sattva Laurel Heights</a></li>                       
                <li><a target="_blank" href="http://salarpuria-sattva-luxuria.contact-us-now.com">Salarpuria Sattva Luxuria</a></li>
                <li><a target="_blank" href="http://www.salarpuriasattvaopus.contact-us-now.com">Salarpuria Sattva Opus</a></li>  
                <li><a target="_blank" href="http://www.salarpuriasattvaparkcubix.contact-us-now.com">Salarpuria Sattva Park Cubix</a></li>
                <li><a target="_blank" href="http://www.shapoorjipallonjiparkwest.contact-us-now.com">Shapoorji Pallonji Parkwest</a></li>           
                <li><a target="_blank" href="http://skylark-ithaca.contact-us-now.com">Skylark Ithaca</a></li>
                <li><a target="_blank" href="http://www.skylarkroyaume.contact-us-now.com/">Skylark Royaume</a></li>
                <li><a target="_blank" href="http://www.sobhaavenue.contact-us-now.com">Sobha Avenue</a></li>                 
                <li><a target="_blank" href="http://sobhacity.contact-us-now.com">Sobha City</a></li>
                <li><a target="_blank" href="http://www.sobhaclovelly.contact-us-now.com/">Sobha Clovelly</a></li>
                <li><a target="_blank" href="http://sobha-dream-acres.contact-us-now.com">Sobha Dream Acres</a></li>
                <li><a target="_blank" href="http://www.sobhagatewayofdreams.contact-us-now.com/">Sobha Gateway of Dreams</a></li>
                <li><a target="_blank" href="http://sobha-greenacres.contact-us-now.com">Sobha Green Acres</a></li>
                <li><a target="_blank" href="http://sobha-halcyon.contact-us-now.com">Sobha Halcyon</a></li>
                <li><a target="_blank" href="http://www.sobhaheritage.contact-us-now.com">Sobha Heritage</a></li>                
                <li><a target="_blank" href="http://sobha-rainforest.contact-us-now.com">Sobha Rain Forest</a></li>
                <li><a target="_blank" href="http://www.sobhasquare.contact-us-now.com">Sobha Square</a></li>
                <li><a target="_blank" href="http://www.totalenvironmentaftertherain.contact-us-now.com">Total Environment After The Rain</a></li>
                <li><a target="_blank" href="http://www.totalenvironmentthemagicfarawaytree.contact-us-now.com">Total Environment The Magic Faraway Tree</a></li>                            
                <li><a target="_blank" href="http://www.totalenvironmentinthatquietearth.contact-us-now.com">Total Environment In That Quiet Earth</a></li> 
                <li><a target="_blank" href="http://www.totalenvironmentlearningtofly.contact-us-now.com">Total Environment Learning To Fly</a></li> 
                <li><a target="_blank" href="http://www.totalenvironmentlostinthegreens.contact-us-now.com">Total Environment Lost In The Greens</a></li>                            
                <li><a target="_blank" href="http://www.unishirexperience.contact-us-now.com/">Unishire Xperience</a></li>
                <li><a target="_blank" href="http://www.vaishnavitriniti.contact-us-now.com">Vaishnavi Triniti</a></li>
                </ul>
              </div></div>
            </div>
            <div class="tabs-panel" id="contact-us">
                <p>
                <b>Address</b><br>
                Book My Homes Estates,<br>
                #34(66), 1st Floor,<br>
                8th Main road, 18th Cross,<br>
                Malleshwaram.<br>
                Bangalore – 560055
                </p>
                <p> 
                <b>Contact No</b><br>
                <a href="tel:+918861864836">(+91) 886 1864836</a><br>
                <a href="tel:+918884765615">(+91) 888 4765615</a><br>
                Email: <a href="mailto:info@bookmyhomes.com">info@bookmyhomes.com</a>
              </p>
              <p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.4174012069557!2d77.56204001482243!3d13.00907049083124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae162ae5059abf%3A0xf911b46ea3d9c4fc!2sBook+My+Homes!5e0!3m2!1sen!2sin!4v1460969205777" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
              </p>

            </div>
          </div>











        </div>
        </div>


      </div>
        
      <!-- Sidebar   -->
      <div class="medium-4 columns"> 
        
<div class="row">
              
        </div>
        <div class="row">
                 <div class="large-12 columns">
            <div class="callout secondary">
          <h3 id="enquiry" class="text-center">ENQUIRY</h3>
            <form action="index.php" method="post">
              <div class="row">
                <div class="large-12 columns">
                   <input name="name" id="name" type="text" placeholder="Name" required>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                   <input name="age" id="age" type="text" placeholder="Age">
                </div>
              </div>

              <div class="row">
                <div class="large-12 columns">
                     <input name="email" id="email" type="email" placeholder="Email" required>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                     <input name="tel" id="tel" type="tel" placeholder="Contact Number" required>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                   <textarea name="message" id="message" placeholder="Your Message"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <input type="submit" class="expanded button" value="Submit" />
                </div>
              </div>
                        
            </form>

            <?php                              
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
              if (empty($_POST["age"])) {    
                $name = $_POST['name'];
                $tel = $_POST['tel'];
                $email = $_POST['email'];
                $message = $_POST['message'] ? $_POST['message'] : "";
              if($name != '' && $tel != '' && $email != '')
                create_lead($name,$tel,$email,$message);
             }
              echo '<strong>Thank You! Our Representatives Will call you within the next 10 minutes. </strong><br>';
               } // end of POST check

               
              ?>
          </div>
        </div>

      </div>
    </div> <!-- End of sidebar -->
  
</div> <!-- end of row -->

        


<div class="copyright">  <p style="color:#2f2f2f">BookMyHomes.com</p>  </div>

    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  <script type="text/javascript">
    function downloadJSAtOnload() {
         var element = document.createElement("script");
         element.src = "/zopim.js";
         document.body.appendChild(element);
     }
     if (window.addEventListener)
        window.addEventListener("load", downloadJSAtOnload, false);
        else if (window.attachEvent)
        window.attachEvent("onload", downloadJSAtOnload);
        else
        window.onload = downloadJSAtOnload;
    </script>

</body>
</html>