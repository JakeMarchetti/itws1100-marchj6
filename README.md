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