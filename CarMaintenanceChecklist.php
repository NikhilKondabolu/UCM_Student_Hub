<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Maintenance Checklist</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            color: #2c3e50;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<nav>
    <a href="Home.php">Home</a>  
    <a href="accommodation.php" class="accommodation"><span>Accommodation</span></a>
    <a href="academic.php" class="academic"><span>Academic</span></a>
    <a href="requestrides.php" class="requestrides"><span>Request Rides</span></a>
    <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
    <a href="calendar.php" class="calendar"><span>Rides Calendar</span></a>
    <a href="courier.php" class="courier"><span>Courier Service</span></a>
    <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
    <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>    
    <a href="logout.php">Logout</a>
</nav>
<div class="container">
    <h1>Time-Stamped Car Maintenance Checklist</h1>
    <p>Preventative car maintenance extends your vehicle's lifespan and ensures it is safe to drive. However, many essential components in your vehicle require inspection, which people sometimes forget. That's why we've created this comprehensive vehicle maintenance checklist, so you never have to worry about forgetting to complete a maintenance task.</p>
    <p>You can also download this car maintenance checklist to help you stay on track with maintenance tasks throughout the year.</p>

    <h2>Immediate Maintenance Tasks</h2>
    <ul>
        <li><strong>Tire Pressure Light:</strong> If your tire pressure light lights up on your dashboard, it indicates that one or more of your tires have low pressure. Check your tire pressure and inspect for any leaks. Driving with low tire pressure can be unsafe, so you should immediately take your vehicle to the nearest air pump to inflate the tires to the recommended pressure.</li>
        <li><strong>Brake System Malfunctions:</strong> If you're noticing any changes in braking, such as slower responsiveness or softness, it's best to have your vehicle's brakes checked. Additionally, if you hear grinding or scraping noises, these are indications that there may be an issue with the brake system. Any abnormalities in the brake system can impact vehicle safety and increase the risk of an accident. Therefore, it's crucial to address brake issues promptly.</li>
        <li><strong>Check Engine Light:</strong> If your check engine light turns on, it indicates that your vehicle's control system has detected a problem it can't fix. Promptly book an appointment at an auto repair shop for an engine inspection. While the light can indicate a minor or serious issue in the transmission or engine, your technician can perform a diagnostic test to confirm the issue.</li>
        <li><strong>Fluid Leaks Under the Vehicle:</strong> If you notice fluids leaking from underneath your car, it's crucial not to ignore it and address it immediately. Leaking fluids can lead to further damage to your vehicle and reduce vehicle safety. A technician should be able to identify the fluid, find the source of the leak, and assess the impact and severity. Driving with a leak isn't recommended and should be avoided to prevent potential safety hazards and additional damage to your vehicle.</li>
    </ul>

    <h2>Monthly Maintenance Tasks</h2>
    <p>Below are maintenance tasks to complete on your vehicle every month.</p>
    <ul>
        <li><strong>Tire Pressure and Wear:</strong> Regularly inspect your tires for optimal air pressure and tread wear to reduce the risk of unexpected blowouts. Look for uneven wear patterns, and replace the tires if you spot any damage or leaks. Ensure your tires reach the recommended air pressure level. Additionally, check your spare tire's air pressure and condition in an emergency.</li>
        <li><strong>Vehicle Fluids:</strong> Check the following vehicle's fluid levels and top them up if they're low:
            <ul>
                <li>Transmission fluid</li>
                <li>Power steering fluid</li>
                <li>Windshield wiper fluid</li>
                <li>Brake fluid</li>
                <li>Coolant</li>
                <li>Antifreeze</li>
            </ul>
            Inspect all the fluids except coolant while the vehicle engine is running and in park. Refer to your owner's manual for the recommended fluid types.</li>
        <li><strong>All Vehicle Lights:</strong> Inspect all of your vehicle's lights to ensure they're operating properly. Check the following lights:
            <ul>
                <li>Headlights</li>
                <li>Fog lights</li>
                <li>Tail lights</li>
                <li>Parking lights</li>
                <li>Turn signals</li>
                <li>Brake lights</li>
                <li>Reverse lights</li>
            </ul>
            Since not all lights are visible to the driver from inside the vehicle, have someone inspect the lights while walking around the car. Driving with dead lights can lead to a traffic ticket and should be replaced immediately.</li>
        <li><strong>Battery and Cables:</strong> Check that all cables are tightly connected to your vehicle's battery. Inspect your battery for any visible corrosion and ensure it is tightly secured in the engine compartment.</li>
    </ul>

    <h2>Quarterly Maintenance Tasks</h2>
    <p>Below are maintenance tasks to complete every three months or 3,000 miles.</p>
    <ul>
        <li><strong>Wiper Blades:</strong> You should replace your windshield wiper blades when they no longer effectively clear the windshield due to wear or damage. Worn-down wiper blades are a safety concern, particularly in harsh driving weather conditions. Fortunately, wiper blades are inexpensive to purchase and easy to replace. Car maintenance tip: Apply a rain repellent on your vehicle's windshields to improve visibility and reduce wiper usage.</li>
        <li><strong>Belts and Hoses:</strong> Check the condition of the serpentine belts and V-Belts. They should be replaced if they show signs of glazing, fraying, or cracking. Additionally, inspect the hoses for any cracks or leaks. Ensure that the hose clamps and connections are tight.</li>
    </ul>

    <h2>Half-Yearly Maintenance Tasks</h2>
    <p>Below are maintenance tasks to complete every six months or every 5,000 to 6,000 miles.</p>
    <ul>
        <li><strong>Engine Oil and Oil Filter:</strong> How often you need an oil change will depend on your vehicle, driving habits, and the type of oil it uses. However, most engines have a recommended oil change interval of 5,000 to 7,500 miles. You should consider getting an oil change if you notice it is dark and has a gritty texture. Additionally, have the oil filter checked for any damage or leaks or if it's noticeably dirty.</li>
        <li><strong>Tire Rotation:</strong> Rotating tires helps maintain even tread wear on all four tires. The tire rotation method required depends on the type of vehicle and tires. Before proceeding, review your manufacturer's recommendations or consult a technician to ensure proper tire rotation.</li>
        <li><strong>Chassis Lubrication:</strong> Not all vehicles require lubrication, as many already have sealed joints and rod ends. However, check the owner's manual to confirm if your vehicle requires periodic lubrication. If necessary, the chassis, suspension, and steering systems will likely need to be lubricated every six months or so.</li>
        <li><strong>Battery Performance:</strong> Starting at three years old, test your battery performance twice a year. Have your battery's voltage level measured, which can be done at an auto repair shop or with a multimeter. Inspect the battery for corrosion, and clean the terminals with baking soda and a little water to remove any noticeable corrosion.</li>
        <li><strong>Exterior Clean and Wax:</strong> Give your car a nice scrub-down every six months to protect the exterior paint and prevent rust. Take your vehicle through a car wash or shine it up at home with proper exterior vehicle cleaning products. You may need to clean your car more often if your vehicle has regular exposure to salt or dirt. You can finish the cleaning process by applying a good coat of car wax to the vehicle's paint. This can be done at home or a car wash. While you're in cleaning mode, clean the interior of your vehicle. Most car washes have vacuum pumps you can use for a small fee, or you can purchase a handheld vacuum that connects to your vehicle. Wipe down the dashboard and doors with microfiber cloths or disinfectant wipes to remove any dust and grime. Car maintenance tip: When washing your vehicle, use a microfiber wash glove or cloth to prevent scratches or marks.</li>
        <li><strong>Exhaust System:</strong> The exhaust system directs exhaust gas out of the vehicle and reduces noise levels. Have a technician inspect the exhaust system every six months for any damages, rust, or leaks. They should examine the muffler, exhaust pipes, and catalytic converter. If you start hearing unusual noises from the muffler, take your vehicle to an auto repair shop.</li>
    </ul>

    <h2>Yearly Maintenance Tasks</h2>
    <p>Below are maintenance tasks to complete annually or every 12,000-15,000 miles.</p>
    <ul>
        <li><strong>Air Filters:</strong> Once a year is a suitable frequency for replacing all the air filters in your vehicle, including the engine and cabin air filters. Over time, these filters become clogged and require replacement. The cabin filter is responsible for keeping the interior air of your car clean from debris such as pollen and dust. Typically, you'll find the cabin filter located under the dashboard or behind the glove box compartment. The engine filter is situated under the hood next to the engine. When checking the filters, look for any damage or leaks that could allow unwanted debris to enter the cabin or engine.</li>
        <li><strong>Brakes and Brake Pads:</strong> Have your brake system inspected by a certified technician. This inspection should cover brake pads, rotors, brake linings, and brake fluid. Typically, you can have the entire system checked once a year, but your brake pads may require more frequent inspection based on your driving habits. On average, it costs $100-$300 per axle to replace the brake pads.</li>
        <li><strong>Suspension and Steering:</strong> Have a technician inspect your vehicle's suspension and steering systems, which include shocks and struts, steering linkage, tie rods, control arms, and springs. The technician should conduct tests to evaluate suspension operation, look for signs of damage or excessive wear, and check wheel alignment.</li>
        <li><strong>Spark Plugs:</strong> Your spark plugs should be inspected annually. The lifespan of spark plugs depends on the vehicle and should be replaced at the manufacturer's recommended intervals, typically every 30,000 miles. Your spark plugs should be tested for electrode erosion and wear.</li>
    </ul>

    <h2>Two-Year Maintenance Tasks</h2>
    <p>Below are maintenance tasks typically recommended to be completed every two years.</p>
    <ul>
        <li><strong>Fuel Filter:</strong> The fuel filter prevents debris from entering the engine. However, it can become clogged over time, causing decreased engine performance. Follow your manufacturer's recommendations for replacement frequency. Generally, the fuel filter should be replaced every 30,000 miles to maintain optimal engine health.</li>
        <li><strong>Transmission and Brake Fluid:</strong> Over time, your vehicle's transmission and brake fluid will deteriorate, leading to decreased vehicle performance. It's recommended to check your fluid levels regularly to ensure the fluid appears clean, reaches optimal levels, and there are no leaks or damage. However, you typically need to replace the fluids every 30,000 miles or two years.</li>
        <li><strong>Ignition System:</strong> The ignition system is a crucial part of your vehicle, as it initiates engine startup and ignites the air-fuel mixture within the engine. The ignition system consists of ignition coils, spark plugs, and plug wires. These components wear out over time and should be inspected for damage and heavy wear. Decreased engine performance and rough idling are signs you need replacement within the ignition system.</li>
        <li><strong>Coolant and Antifreeze:</strong> The coolant and antifreeze should be replaced every two years or 30,000 miles. Additionally, it's recommended to have your coolant flushed every 30,000 to 60,000 miles. The frequency of coolant flushing will depend on your vehicle's manufacturer's recommendations.</li>
    </ul>

    <h2>Long-Term Maintenance Tasks</h2>
    <p>Below are maintenance tasks to complete every three to five years or as needed.</p>
    <ul>
        <li><strong>Timing Belt:</strong> The timing belt, which controls the rotation of the crankshaft and camshafts, will need replacement based on the manufacturer's manual recommendation. A replacement is commonly recommended every 60,000 to 100,000 miles.</li>
        <li><strong>Tire Change:</strong> The frequency of tire replacement depends on driving conditions, tire type, and tread wear. The typical recommendation is to replace tires every 6 to 10 years, regardless of tread wear. However, tires need replacement when they reach a tread depth of 2/32 of an inch. If you live in a climate with harsh winter conditions, you may need to switch to winter tires during those months and change back to regular tires in warmer weather.</li>
        <li><strong>Battery:</strong> Begin testing your battery once it's three years old. Generally, car batteries last between three to five years and should be replaced after five years to prevent the battery from dying unexpectedly and causing you to require Roadside Assistance.</li>
    </ul>
</div>
<footer>
    <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
</footer>
</body>
</html>
