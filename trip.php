<?php
// PHP logic (if any) can go here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kashmir Trip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 20px;
        }
        header h1 {
            margin: 0;
        }
        .content {
            padding: 20px;
        }
        .destination {
            margin-bottom: 20px;
        }
        .destination h2 {
            color: #003366;
        }
        .destination p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }
        .gallery {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .gallery img {
            width: 30%;
            height: auto;
            border-radius: 10px;
            margin: 10px;
        }
        .back-link {
            display: block;
            text-align: center;
            font-size: 40px; 
            color: #003366;
            text-decoration: none;
            margin-top: 20px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* New schedule section styles */
        .schedule {
            background-color: #e2f1ff;
            padding: 20px;
            margin-top: 40px;
            border-radius: 10px;
        }
        .schedule h2 {
            color: #003366;
        }
        .schedule table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .schedule th, .schedule td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .schedule th {
            background-color: #003366;
            color: white;
        }
        .schedule tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .schedule td.time {
            width: 15%;
            text-align: center;
            font-weight: bold;
        }
        .schedule td.activity {
            width: 85%;
        }
    </style>
</head>
<body>

    <header>
        <h1>Explore Kashmir - A Trip to Paradise</h1>
        <p><h2><u>Your adventure begins here</u></h2></p>
    </header>
    
    <section>
        
    <div class="content">
    <section class="destination">
        <h2><u>DESTINATIONS</u></h2>
            <h2>1. SRINAGAR</h2>
            <p><h3>Srinagar, the summer capital of Jammu and Kashmir, is famous for its beautiful lakes, traditional houseboats, and lush gardens. 
                Don’t miss a shikara ride on Dal Lake and a visit to the Mughal Gardens.</h3></p>
        </section>

        <section class="destination">
            <h2>2. GULMARG</h2>
            <p><h3>Known as the 'Meadow of Flowers', Gulmarg is a beautiful hill station and ski resort. 
                Whether you're skiing in winter or hiking in summer, the scenic beauty will captivate you.</h3></p>
        </section>

        <section class="destination">
            <h2>3. PAHALGAM</h2>
            <p><h3>Located along the Lidder River, Pahalgam is known for its pleasant weather and is perfect for trekking, fishing, and pony rides.</h3></p>
        </section>

        <section class="destination">
            <h2>4. SONAMARG</h2>
            <p><h3>Sonamarg is known for its stunning glaciers, meadows, and rivers. 
                It's a popular spot for trekkers and nature lovers who wish to experience the untouched beauty of Kashmir.</h3></p>
        </section>

        <section class="destination">
            <h2>5. LEH-LADAKH (GATEWAY FROM KASHMIR)</h2>
            <p><h3>Though located on the border of Kashmir, Leh-Ladakh offers some of the most dramatic landscapes in the world. 
                High-altitude lakes and snow-capped mountains make it a must-visit destination.</h3></p>
        </section>

        <section>
            <h2><u>GALLERY</u></h2>
            <div class="gallery">
                <img src="images\kashmir.jpg" alt="Kashmir">
                <img src="images\srinagar.jpg" alt="SRINAGAR">
                <img src="images\gulmarg.jpg" alt="GULMARG">
                <img src="images\pahalgam.jpg" alt="PAHALGAM">
                <img src="images\sonmarg.jpg" alt="SONAMARG">
                <img src="images\lehladakh.jpeg" alt="LEH-LADAKH">
            </div>
        </section>
        
        <!-- Trip Instructions Section -->
        <section id="instructions" class="instructions">
            <h2><u>Trip Instructions</u></h2>
            <ul>
                <li><strong>Best Time to Visit:</strong> The best time to visit Kashmir is between March and October, with summer (May-July) being perfect for sightseeing, and winter (November-February) ideal for snow activities like skiing and snowboarding.</li>
                <li><strong>Weather and Clothing:</strong> Kashmir experiences cold winters and mild summers. Be sure to pack warm clothes, especially if traveling during winter (heavy jackets, woolens, and thermals). In summer, light clothing with a sweater is advisable.</li>
                <li><strong>Health Precautions:</strong> Ensure you're carrying necessary medications. If traveling to higher altitudes (like Leh-Ladakh), consult a doctor beforehand, as altitude sickness can affect some travelers.</li>
                <li><strong>Local Customs:</strong> Respect local traditions and culture, especially when visiting religious sites. Modest dressing is recommended, and be respectful of the local people.</li>
                <li><strong>Transport:</strong> Kashmir has well-established public transport. You can also hire local taxis for sightseeing. For a unique experience, consider taking a shikara ride on Dal Lake in Srinagar.</li>
                <li><strong>Safety:</strong> Always follow safety guidelines when engaging in adventure activities such as trekking, skiing, and rafting. Make sure you're accompanied by a certified guide or instructor.</li>
                <li><strong>Cash and ATMs:</strong> Carry enough cash as some remote areas may not have ATMs. Major towns like Srinagar and Pahalgam have ATMs, but rural areas may not.</li>
                <li><strong>Travel Insurance:</strong> It’s always a good idea to have travel insurance, particularly if you're engaging in adventure activities or traveling to remote areas.</li>
                <li><strong>Food and Water:</strong> Be cautious about street food, and drink bottled or filtered water to avoid stomach issues. Kashmir is famous for its Wazwan cuisine, so don’t miss out on trying the local dishes.</li>
                <strong>Environmental Responsibility:</strong> Respect nature. Dispose of waste responsibly, and avoid littering in natural areas. Kashmir’s beauty depends on its pristine environment, so be a responsible traveler.
            </ul>
        </section>
        <!-- Faculty and Students Section -->
        <section class="attendees">
            <h2><u>FACULTY ATTENDING THE TRIP</u></h2>
            <h3><strong>FACULTY:</strong></h3>
            
                <H3><li>Dr. A. N. Sharma (Head of Department)</li>
                <li>Prof. R. Kumar (Trip Coordinator)</li>
                <li>Dr. S. Verma (Faculty, MCA Department)</li>
                <li>MRS. S.SHARMA (Faculty, MCA Department)</li>
                <li>MRS. H.KOLHE (Faculty, MCA Department)</li></H3>
            </ul>
        </section>

        <!-- New Time-based Trip Schedule Section -->
        <section class="schedule">
            <h2><u>Trip Timetable</u></h2>
            <table>
                <thead>
                    <tr>
                        <th class="time">Date</th>
                        <th class="time">Time</th>
                        <th class="activity">Activity</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Day 1: Departure from DY Patil, Pune -->
                    <tr>
                        <td class="time">February 1, 2025</td>
                        <td class="time">6:00 AM</td>
                        <td class="activity">Departure from DY Patil Pune Airport</td>
                    </tr>
                    <tr>
                        <td class="time">February 1, 2025</td>
                        <td class="time">8:00 AM</td>
                        <td class="activity">Arrival in Srinagar Airport</td>
                    </tr>

                    <!-- Day 1: Srinagar -->
                    <tr>
                        <td class="time">February 1, 2025</td>
                        <td class="time">10:00 AM</td>
                        <td class="activity">Shikara ride on Dal Lake</td>
                    </tr>
                    <tr>
                        <td class="time">February 1, 2025</td>
                        <td class="time">12:00 PM</td>
                        <td class="activity">Visit Mughal Gardens (Shalimar Bagh, Nishat Bagh)</td>
                    </tr>
                    <tr>
                        <td class="time">February 1, 2025</td>
                        <td class="time">1:30 PM</td>
                        <td class="activity">Lunch at a local restaurant</td>
                    </tr>
                    <tr>
                        <td class="time">February 1, 2025</td>
                        <td class="time">3:30 PM</td>
                        <td class="activity">Explore local markets and shop for traditional handicrafts</td>
                    </tr>

                    <!-- Day 2: Gulmarg -->
                    <tr>
                        <td class="time">February 2, 2025</td>
                        <td class="time">7:00 AM</td>
                        <td class="activity">Breakfast at the hotel</td>
                    </tr>
                    <tr>
                        <td class="time">February 2, 2025</td>
                        <td class="time">9:00 AM</td>
                        <td class="activity">Depart for Gulmarg</td>
                    </tr>
                    <tr>
                        <td class="time">February 2, 2025</td>
                        <td class="time">11:00 AM</td>
                        <td class="activity">Arrive in Gulmarg, enjoy skiing or a Gondola ride</td>
                    </tr>
                    <tr>
                        <td class="time">February 2, 2025</td>
                        <td class="time">1:30 PM</td>
                        <td class="activity">Lunch at a local restaurant</td>
                    </tr>
                    <tr>
                        <td class="time">February 2, 2025</td>
                        <td class="time">3:00 PM</td>
                        <td class="activity">Explore the meadows and enjoy the natural beauty</td>
                    </tr>
                    <tr>
                        <td class="time">February 2, 2025</td>
                        <td class="time">5:00 PM</td>
                        <td class="activity">Return to Srinagar</td>
                    </tr>

                    <!-- Day 3: Pahalgam -->
                    <tr>
                        <td class="time">February 3, 2025</td>
                        <td class="time">7:00 AM</td>
                        <td class="activity">Breakfast at the hotel</td>
                    </tr>
                    <tr>
                        <td class="time">February 3, 2025</td>
                        <td class="time">9:00 AM</td>
                        <td class="activity">Drive to Pahalgam</td>
                    </tr>
                    <tr>
                        <td class="time">February 3, 2025</td>
                        <td class="time">11:00 AM</td>
                        <td class="activity">Visit Betaab Valley and Aru Valley</td>
                    </tr>
                    <tr>
                        <td class="time">February 3, 2025</td>
                        <td class="time">1:30 PM</td>
                        <td class="activity">Lunch at a riverside restaurant</td>
                    </tr>
                    <tr>
                        <td class="time">February 3, 2025</td>
                        <td class="time">3:30 PM</td>
                        <td class="activity">Take a pony ride or enjoy fishing in the Lidder River</td>
                    </tr>

                    <!-- Day 4: Sonamarg -->
                    <tr>
                        <td class="time">February 4, 2025</td>
                        <td class="time">7:00 AM</td>
                        <td class="activity">Breakfast at the hotel</td>
                    </tr>
                    <tr>
                        <td class="time">February 4, 2025</td>
                        <td class="time">9:00 AM</td>
                        <td class="activity">Depart for Sonamarg</td>
                    </tr>
                    <tr>
                        <td class="time">February 4, 2025</td>
                        <td class="time">11:00 AM</td>
                        <td class="activity">Arrive at Sonamarg and explore glaciers and meadows</td>
                    </tr>
                    <tr>
                        <td class="time">February 4, 2025</td>
                        <td class="time">1:30 PM</td>
                        <td class="activity">Lunch at a local spot</td>
                    </tr>
                    <tr>
                        <td class="time">February 4, 2025</td>
                        <td class="time">3:00 PM</td>
                        <td class="activity">Trek or explore the Thajiwas Glacier</td>
                    </tr>

                    <!-- Day 5: Leh Ladakh -->
                    <tr>
                        <td class="time">February 5, 2025</td>
                        <td class="time">6:00 AM</td>
                        <td class="activity">Early morning flight to Leh</td>
                    </tr>
                    <tr>
                        <td class="time">February 5, 2025</td>
                        <td class="time">8:00 AM</td>
                        <td class="activity">Arrive in Leh, check-in at the hotel</td>
                    </tr>
                    <tr>
                        <td class="time">February 5, 2025</td>
                        <td class="time">11:00 AM</td>
                        <td class="activity">Visit Pangong Lake</td>
                    </tr>
                    <tr>
                        <td class="time">February 5, 2025</td>
                        <td class="time">1:30 PM</td>
                        <td class="activity">Lunch by the lake</td>
                    </tr>
                    <tr>
                        <td class="time">February 5, 2025</td>
                        <td class="time">3:30 PM</td>
                        <td class="activity">Explore Leh markets and monasteries</td>
                    </tr>

                </tbody>
            </table>
        </section>
         <!-- Consent Form Section -->
         <section class="consent-form">
            <h2><u>PARENTAL CONSENT FORM</u></h2>
            <p><H3>Before allowing your child to participate in this trip, we require parents to complete a consent form. This form includes necessary details like parent/guardian contact information, child's name, trip details, and agreement to participate.</p>
            <H3>Please fill out the <a href="PARENTCONSENTFORM.pdf" target="_blank">Parental Consent Form</a> to grant permission for your child to join the trip.</H3></p>
        </section>
        
        <h6><a href="homepage.php" class="back-link">BACK</a></h6>
    </div>
    
</body>
</html>
