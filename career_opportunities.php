<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- Created by Kondabolu -->
    <title>Career Opportunities - TechSphere Nexus</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .job-opportunity,
        .internship-opportunity {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .opportunity-title {
            font-size: 18px;
            font-weight: bold;
        }

        .opportunity-details {
            margin-top: 10px;
        }

        .opportunity-details p {
            margin: 5px 0;
        }

        .job-opening,
        .internship-opening {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .apply-button {
            background-color: #007BA7;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav>
        <a href="home.php">Home</a>
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

    <div class="content">
        <h2>Career Opportunities</h2>

        <!-- Job Openings Section -->
        <div class="job-opportunity">
            <div class="opportunity-title">Current Job Openings</div>
            <div class="opportunity-details">
                <div class="job-opening" id="job1">
                    <p><strong>Job Role:</strong> Software Engineer</p>
                    <p><strong>Department:</strong> Information Technology</p>
                    <p><strong>Location:</strong> Onsite/Remote</p>
                    <p><strong>Responsibilities:</strong> Develop user-friendly web interfaces along with backend development, optimize application performance and testing</p>
                    <p><strong>Qualifications:</strong> Master's degree in Computer Science or related field, strong proficiency in Java with Spring boot or C# .Net MVC</p>
                    <a href="https://www.linkedin.com/jobs/search/?currentJobId=3981325985&keywords=software%20engineer" target="_blank" target="_blank"><button class="apply-button">Apply On LinkedIn</button></a>
                    <a href="https://www.indeed.com/jobs?q=Software+Engineer&l=&from=searchOnDesktopSerp&vjk=fe1e848bcb0ba870" target="_blank"><button class="apply-button">Apply On Indeed</button></a>
                    <a href="https://ucmo.joinhandshake.com/stu/postings?page=1&per_page=25&sort_direction=desc&sort_column=default&query=Software%20Engineer" target="_blank"><button class="apply-button">Apply On HandShake</button></a>
                </div>
                <div class="job-opening" id="job2">
                    <p><strong>Job Title:</strong> Data Analyst</p>
                    <p><strong>Department:</strong> Data Analytics</p>
                    <p><strong>Location:</strong> New York City/ California Bay Area</p>
                    <p><strong>Responsibilities:</strong> Analyze complex datasets, build predictive models, visualize data insights, communicate findings to stakeholders.</p>
                    <p><strong>Qualifications:</strong> Master's degree in Statistics, Mathematics, or related field, proficiency in programming (Python, R), experience with machine learning algorithms and tools.</p>
                    <a href="https://www.linkedin.com/jobs/search?keywords=Data%20Analyst&location=United%20States&geoId=103644278&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0" target="_blank"><button class="apply-button">Apply On LinkedIn</button></a>
                    <a href="https://www.indeed.com/jobs?q=data+analyst&l=&from=searchOnDesktopSerp&vjk=4a4d828f1820cadb" target="_blank"><button class="apply-button">Apply On Indeed</button></a>
                    <a href="https://ucmo.joinhandshake.com/stu/postings?page=1&per_page=25&sort_direction=desc&sort_column=default&query=Data%20Analyst" target="_blank"><button class="apply-button">Apply On HandShake</button></a>
                </div>
                <div class="job-opening" id="job3">
                    <p><strong>Job Title:</strong> IT Security Analyst</p>
                    <p><strong>Department:</strong> Information Security</p>
                    <p><strong>Location:</strong> San Francisco, Dallas/ Remote</p>
                    <p><strong>Responsibilities:</strong> Monitor network traffic, detect security breaches, conduct vulnerability assessments, implement security measures.</p>
                    <p><strong>Qualifications:</strong> Master's degree in Cybersecurity, Information Technology, or related field, knowledge of security protocols and encryption algorithms, experience with security tools (e.g., SIEM, IDS/IPS).</p>
                    <a href="https://www.linkedin.com/jobs/search?keywords=IT%20Security%20Analyst&location=United%20States&geoId=103644278&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0" target="_blank"><button class="apply-button">Apply On LinkedIn</button></a>
                    <a href="https://www.indeed.com/jobs?q=IT+Security+Analyst&l=&from=searchOnDesktopSerp&vjk=51b908c421f2a60b" target="_blank"><button class="apply-button">Apply On Indeed</button></a>
                    <a href="https://ucmo.joinhandshake.com/stu/postings?page=1&per_page=25&sort_direction=desc&sort_column=default&query=IT%20Security%20Analyst" target="_blank"><button class="apply-button">Apply On HandShake</button></a>
                </div>
            </div>
        </div>

        <!-- Internship Opportunities Section -->
        <div class="internship-opportunity">
            <div class="opportunity-title">Internship Opportunities</div>
            <div class="opportunity-details">
                <div class="internship-opening" id="internship1">
                    <p><strong>Internship Title:</strong> Software Engineering Intern</p>
                    <p><strong>Department:</strong> Engineering</p>
                    <p><strong>Duration:</strong> 5 months</p>
                    <p><strong>Responsibilities:</strong> Assist in software development projects, write code, perform testing, participate in team meetings.</p>
                    <p><strong>Eligibility:</strong> Currently pursuing a degree in Computer Science or related field, strong programming skills (preferably in Java, Python).</p>
                    <a href="https://www.linkedin.com/jobs/search?keywords=Software%20Engineering%20Intern&location=United%20States&geoId=103644278&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0" target="_blank"><button class="apply-button">Apply On LinkedIn</button></a>
                    <a href="https://www.indeed.com/jobs?q=Software+Engineering+Intern&l=&from=searchOnDesktopSerp&vjk=eba42a11a76b194a" target="_blank"><button class="apply-button">Apply On Indeed</button></a>
                    <a href="https://ucmo.joinhandshake.com/stu/postings?page=1&per_page=25&sort_direction=desc&sort_column=default&query=Software%20Engineering%20Intern" target="_blank"><button class="apply-button">Apply On HandShake</button></a>
                </div>
                <div class="internship-opening" id="internship2">
                    <p><strong>Internship Title:</strong> Marketing Intern</p>
                    <p><strong>Department:</strong> Marketing</p>
                    <p><strong>Duration:</strong> 4 months</p>
                    <p><strong>Responsibilities:</strong> Support marketing campaigns, create social media content, conduct market research, assist with event planning.</p>
                    <p><strong>Eligibility:</strong> Pursuing a degree in Marketing, Communications, or related field, strong communication skills, familiarity with social media platforms.</p>
                    <a href="https://www.linkedin.com/jobs/search?keywords=Marketing%20Intern&location=United%20States&geoId=103644278&trk=public_jobs_jobs-search-bar_search-submit&original_referer=https%3A%2F%2Fwww.linkedin.com%2Fjobs%2Fsearch%3Fkeywords%3DData%2520Analysis%2520Intern%26location%3DUnited%2520States%26geoId%3D103644278%26trk%3Dpublic_jobs_jobs-search-bar_search-submit%26position%3D1%26pageNum%3D0&position=1&pageNum=0" target="_blank"><button class="apply-button">Apply On LinkedIn</button></a>
                    <a href="https://www.indeed.com/jobs?q=Marketing+Intern&l=&from=searchOnDesktopSerp&vjk=893799bd9c2bc9d2" target="_blank"><button class="apply-button">Apply On Indeed</button></a>
                    <a href="https://ucmo.joinhandshake.com/stu/postings?page=1&per_page=25&sort_direction=desc&sort_column=default&query=Marketing%20Intern" target="_blank"><button class="apply-button">Apply On HandShake</button></a>
                </div>
                <div class="internship-opening" id="internship3">
                    <p><strong>Internship Title:</strong> Data Analysis Intern</p>
                    <p><strong>Department:</strong> Data Analytics</p>
                    <p><strong>Duration:</strong> 12 weeks</p>
                    <p><strong>Responsibilities:</strong> Clean and preprocess data, perform statistical analysis, generate reports, assist with dashboard development.</p>
                    <p><strong>Eligibility:</strong> Enrolled in a statistics, mathematics, or data science program, familiarity with statistical software (e.g., R, SAS), attention to detail.</p>
                    <a href="https://www.linkedin.com/jobs/search?keywords=Data%20Analysis%20Intern&location=United%20States&geoId=103644278&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0" target="_blank"><button class="apply-button">Apply On LinkedIn</button></a>
                    <a href="https://www.indeed.com/jobs?q=Data+Analysis+Intern&l=&from=searchOnDesktopSerp&vjk=eca687750721e112" target="_blank"><button class="apply-button">Apply On Indeed</button></a>
                    <a href="https://ucmo.joinhandshake.com/stu/postings?page=1&per_page=25&sort_direction=desc&sort_column=default&query=Data%20Analysis%20Intern" target="_blank"><button class="apply-button">Apply On HandShake</button></a>
                </div>
            </div>
        </div>

        <section id="applicationProcedures">
            <h2>Application Procedures</h2>
            <p>Follow the instructions below to apply for job openings and internships:</p>
            <ol>
                <li>Review the job descriptions and internship details above.</li>
                <li>Prepare your resume and cover letter.</li>
                <li>Submit your application via the job portals.</li>
            </ol>
            <p>Contact us at careers@UcmStudentHub.com for any inquiries related to career opportunities.</p>
        </section>

    </div>

    <footer>
        <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
    </footer>

</body>

</html>