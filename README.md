# itws1100-marchj6
Lab 01 – VM, GitHub & Azure Setup
Overview
This lab focuses on setting up the development environment used throughout the course, including an Azure Virtual Machine, GitHub repository integration, and basic web server configuration.
Azure VM Setup
Azure Virtual Machine successfully created and running
VM configured according to course specifications
SSH access configured and verified

Azure VM FQDN:
http://marchj6rpi.eastus.cloudapp.azure.com

GitHub Setup:
GitHub account created and profile configured
Course repository created with proper structure
Repository connected to Azure VM for deployment

GitHub Repository:
https://github.com/JakeMarchetti/itws1100-marchj6

Web Server Configuration:
Apache web server installed and running
Default website replaced with custom content
Website accessible via Azure FQDN



Lab 02 – HTML Resume
Overview:
This lab involved creating a semantic HTML5 resume with external CSS styling, validating it against W3C standards, and deploying it to Azure.

Validation:
HTML validated using W3C Validator
No validation errors
Proper DOCTYPE, charset, and viewport meta tags included

Code Quality:
Consistent indentation
Semantic HTML5 elements used:
header, section, article, footer
No inline styles (external CSS only)

Resume Content:
Included sections:
Contact information
Education
Skills
Experience / Projects
Additional sections (if applicable)

Styling:
External CSS file used
Professional layout and readable typography

Repository Structure:
lab02/
├── index.html
├── css/
│   └── style.css
└── README.md
Live Deployment

Resume URL:
http://marchj6rpi.eastus.cloudapp.azure.com/iit/labs/lab02/
GitHub

Multiple commits showing development progress
Repository accessible and organized



Lab 03 – Personal Website
Overview:
This lab involved building a multi-page personal website with consistent navigation, styling, and structure.

Pages Included:
index.html – Homepage
labs.html or projects.html
Individual lab landing pages

Site Structure
iit/
├── index.html
├── README.md
├── css/
│   └── style.css
├── images/
└── labs/
    ├── index.html
    └── lab02/

Validation:
All HTML files pass W3C validation
CSS file passes W3C CSS validation

Design & Navigation:
Consistent header, navigation, and footer across all pages
Fully functional internal navigation

External CSS only:
Creativity:
Custom color scheme and layout
Responsive design considerations
Personalized branding and content

GitHub Workflow:
lab03 branch created
Proper commit messages
Pull request created and merged

Website URL:
http://marchj6rpi.eastus.cloudapp.azure.com/iit/projectsite



Lab 03b – AI-Assisted Web Development
Overview:
This lab explores AI-assisted development by iteratively improving the personal website using AI-generated suggestions.

Workflow:
Created a lab3b branch (not merged into main)
Used AI tools to assist with design and content
Completed 5 iterations, each committed separately

AI Iterations
Each iteration includes:
Prompt used
AI-generated output
Manual refinement and evaluation

Deliverables:
lab3b branch with at least 5 commits

Reflection document included in:
labs/lab3b/REFLECTION-DOC-LAB-3b.docx

The reflection discusses:
Prompt engineering
Strengths and limitations of AI assistance
How AI output changed based on prompt refinement
Lessons learned about AI-assisted development



Lab 04 – RSS & Atom Feeds
Overview:
This lab involved creating valid RSS 2.0 and Atom 1.0 feeds linking to completed labs and deploying them live.

Feeds Created:
RSS 2.0 feed
Atom 1.0 feed

Validation:
RSS validated using W3C Feed Validator
Atom validated using W3C Feed Validator
XML is well-formed and specification-compliant

Feed Content:
Each feed contains at least 4 items, linking to:
Lab 01 – VM Setup
Lab 02 – HTML Resume
Lab 03 – Personal Website
Additional labs (if applicable)

Styling:
XML stylesheet processing instruction included:
<?xml-stylesheet type="text/css" href="rss.css"?>
CSS file present and applied

Repository Workflow:
lab04 branch created and used
Multiple commits showing progress
Pull request created and merged
Live Deployment

RSS Feed:
http://<your-azure-domain>/lab04/rss.xml

Atom Feed:
http://<your-azure-domain>/lab04/atom.xml
Landing Page

Lab 04 landing page created
Includes feed links and descriptions



Lab 05 – JavaScript Form Validation
Overview:
This lab involved adding client-side JavaScript form validation and interactive form behavior to a contact form page, while also correcting HTML and CSS validation issues and deploying the completed work to Azure.

Form Validation:
JavaScript validation added to the form
No required fields may be left blank
Validation checks included for:
First Name
Last Name
Title
Organization
Nickname
Comments

User Feedback:
Alert messages displayed when required fields are missing
Cursor returns focus to the field requiring correction
Success alert displayed when the form is submitted correctly

Textarea Behavior:
Textarea clears default instructional text when clicked
Only the text "Please enter your comments" is removed
User-entered comments are preserved
If left blank when focus is lost, the default instructional text is restored

Additional JavaScript Feature:
A button was added below the Contact Information section
The button displays an alert in the format:
"firstName lastName is nickname"

HTML & CSS Corrections:
Crime #1 in the HTML was corrected
Crime #4 in the CSS was corrected by applying a focused field background color of #fee

Validation:
HTML validates successfully
CSS validates successfully
JavaScript formatted consistently according to course guidelines

Code Quality:
Consistent indentation used throughout
Curly braces used on all control statements
External CSS and JavaScript files linked properly
Readable formatting and structure maintained

Repository Workflow:
lab05 branch created and used for development
Multiple commits showing development progress
Pull request created and merged into main

Live Deployment

Lab 05 URL:
http://marchj6rpi.eastus.cloudapp.azure.com/iit/projectsite/lab5.html

GitHub:
Repository updated and deployed successfully to Azure



Lab 06 – jQuery
Overview:
This lab involved using jQuery to add interactive behavior to a webpage, including event handling, DOM manipulation, visual effects, class toggling, dynamic list item creation, and deployment of the completed work to Azure.

jQuery Setup:
jQuery was linked properly before the custom lab6.js file
All JavaScript code was placed inside the document ready function
The page confirms DOM readiness before allowing interaction

Problem 1 – Heading Interaction:
Clicking the h1 changes "Your Name" to my actual name
The name text changes to small caps
The text color changes to pink, which is neither blue nor black
The font size changes to 200% of normal size

Problem 2 – Hide and Show Text:
The lorem ipsum paragraphs disappear over a 2 second duration when "Hide Text" is clicked
The paragraphs reappear over a 3.3 second duration when "Show Text" is clicked
Default link behavior was prevented so the page does not jump unexpectedly

Problem 3 – List Item Class Toggling:
Clicking a normal list item adds the .red CSS class using jQuery
Clicking a red list item removes the .red class
This creates a toggle effect between normal and red list items

Problem 4 – Add List Item:
Clicking the "Add list item" button appends a new li element to the end of the unordered list
The new item is added dynamically using jQuery .append()

Problem 5 – New List Item Click Behavior:
At first, newly added list items did not behave like the original list items when clicked
This happened because the original click handler was attached only to the li elements that existed when the page first loaded
New li elements added later with .append() did not automatically receive that click handler
This issue was fixed using jQuery event delegation with .on('click', 'li', ...) attached to the parent #labList element
After this fix, both original and newly added list items correctly toggle the .red class when clicked

Toggle Text Feature:
The "Toggle Text" link uses another jQuery method, .toggle()
This allows the paragraphs to alternate between shown and hidden states with animation
Default link behavior was prevented for smoother interaction

Validation:
HTML updated to use the proper viewport meta tag format
CSS validates successfully
JavaScript is organized and formatted consistently according to course guidelines

Code Quality:
Consistent indentation used throughout
Event handlers are grouped clearly inside the document ready block
External CSS and JavaScript files are linked properly
Readable formatting and structure were maintained

Repository Workflow:
lab06 branch created and used for development
Multiple commits showing development progress
Pull request created and merged into main

Live Deployment

Lab 06 URL:
http://marchj6rpi.eastus.cloudapp.azure.com/iit/projectsite/lab6.html

GitHub:
Repository updated and deployed successfully to Azure