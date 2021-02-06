-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 01:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brighter`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`) VALUES
(1, 'Design', 'entities\\thumbnails\\category\\1.jpg'),
(2, 'Business', 'entities\\thumbnails\\category\\2.jpg'),
(3, 'Software Development', 'entities\\thumbnails\\category\\3.jpg'),
(4, 'Web Development', 'entities\\thumbnails\\category\\4.jpg'),
(5, 'Photography', 'entities\\thumbnails\\category\\5.jpg'),
(6, 'Audio + Music', 'entities\\thumbnails\\category\\6.jpg'),
(7, 'Marketing', 'entities\\thumbnails\\category\\7.jpg'),
(8, '3D + Animation', 'entities\\thumbnails\\category\\8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `certificate` varchar(1000) NOT NULL,
  `reference_id` varchar(500) NOT NULL,
  `issue_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `learner_id`, `course_id`, `certificate`, `reference_id`, `issue_date`) VALUES
(52, 41, 23, 'certificate/certificate/202041.23.Parth Butani.jpg', '34313233', '2020-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `message`, `email`, `subject`, `date`) VALUES
(2, 'parth', 'this for testing purpose', 'group4559@gmail.com', 'contact us', '2020-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE `entities` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `thumbnail` varchar(250) NOT NULL DEFAULT 'entities/thumbnails/bel.jpg',
  `categoryId` int(11) NOT NULL,
  `short_des` text NOT NULL DEFAULT '\'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been \'',
  `long_des` text NOT NULL DEFAULT '\'\\\'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.\\\'\'',
  `teacherid` int(11) DEFAULT NULL,
  `duration` varchar(50) NOT NULL DEFAULT '02:00:00',
  `student_en` varchar(3000) NOT NULL DEFAULT '109',
  `language` text NOT NULL DEFAULT 'English',
  `overview` text NOT NULL DEFAULT '\'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.\'',
  `requirmnet` text NOT NULL DEFAULT '\'\\\'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.\\\'\'',
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`id`, `name`, `thumbnail`, `categoryId`, `short_des`, `long_des`, `teacherid`, `duration`, `student_en`, `language`, `overview`, `requirmnet`, `status`) VALUES
(1, 'Wordpress for Beginners - Master Wordpress Quickly', 'entities/thumbnails/Wordpress_master.jpg', 4, 'In 2020, build a beautiful responsive Wordpress site that looks great on all devices. No experience required.', 'Wordpress for Beginners - A Complete Guide to Wordpress!\r\n\r\nIn 2020, it\'s never been easier to build a fantastic, responsive website that looks great on computers, tablets, and mobile phones.  \r\n\r\nYou can learn Wordpress WITHOUT having to buy web hosting or a domain name.  I\'ll show you how you can set it all up on your own computer using free tools. \r\n\r\nNOTE: This course will always be updated to cover the latest version of WordPress.  Covers WordPress 5.0 and earlier.\r\n\r\nThe primary goal of this course is to teach anyone, even a complete beginner, how to become a Wordpress guru in a few short hours, without lots of technical jargon.', 5, '02:00', '0', 'English', 'Install Wordpress on your PC or Mac computer, so you can learn without having to pay hosting or domain fees.\r\nThis course will teach anyone to build a functional, beautiful, responsive website with Wordpress.', 'No prior knowledge of Wordpress is required as everything will be covered in this course.\r\n\r\nYou will need a working computer and a web browser connected to the internet.\r\n\r\nYou don\'t need any coding experience at all. That is the beauty of Wordpress.', 1),
(2, 'Web Design for Beginners: Real World Coding in HTML & CSS', 'entities/thumbnails/WordPressforBeginnersCreate.jpg', 4, 'Launch a career as a web designer by learning HTML5, CSS3, responsive design, Sass and more!', 'You can launch a new career in web development today by learning HTML & CSS. You don\'t need a computer science degree or expensive software. All you need is a computer, a bit of time, a lot of determination, and a teacher you trust. I\'ve taught HTML and CSS to countless coworkers and held training sessions for fortune 100 companies. I am that teacher you can trust. \r\n\r\nDon\'t limit yourself by creating websites with some cheesy “site-builder\" tool. This course teaches you how to take 100% control over your webpages by using the same concepts that every professional website is created with.\r\n', 2, '00:06', '0', 'English', 'Create any website layout you can imagine\r\nSupport any device size with Responsive (mobile-friendly) Design\r\nAdd tasteful animations and effects with CSS3\r\nUse common vocabulary from the design industry', 'No prerequisite knowledge required\r\nNo special ($$$) software required', 1),
(3, 'CSS - The Complete Guide 2020 (incl. Flexbox, Grid & Sass)', 'entities/thumbnails/cssweb.jpg', 4, 'Learn CSS for the first time or brush up your CSS skills and dive in even deeper. EVERY web developer has to know CSS.', 'CSS - short for Cascading Style Sheets - is a \"programming language\" you use to turn your raw HTML pages into real beautiful websites.\r\n\r\nThis course covers it all - we start at the very basics (What is CSS? How does it work? How do you use it)? and gradually dive in deeper and deeper. And we do this by showing both practical examples as well as the theory behind it.', 1, '02:00:00', '0', 'English', 'Build beautiful websites which don\'t just contain great content but also look good.\r\nUse basic as well as advanced CSS features.\r\nUnderstand the concepts and theory behind CSS and certain CSS features.', 'You should know the very basics about HTML and web development in general\r\nNO advanced HTML or web development knowledge is required though\r\nNO CSS knowledge is required at all! You\'ll learn it all in this course!', 1),
(4, 'WordPress for Beginners: Create a Website Step by Step', 'entities/thumbnails/WordPressforBeginnersCreate.jpg', 4, 'Create Websites and Blogs With Zero Experience Using WordPress and This Step By Step Guide', 'Whether you want to create websites without coding, or you need to learn WordPress so you can update existing websites at your job, I\'ve got you covered.\r\n\r\nIn this brisk but thorough course we build a website together step-by-step and along the way you organically absorb and master WordPress. I\'m all about having you follow along with me and I always encourage experimentation over memorization. My ultimate goal is to give you the \"vocabulary of WordPress\" so you can continue learning independently long after this course completes.', 2, '02:00:00', '0', 'English', 'Create websites and blogs with WordPress.\r\nUpdate and edit existing WordPress websites.\r\nSetup dynamic blog sections organized by category.\r\nCreate a \"Contact Us\" page with interactive map and email form.', 'No prerequisite knowledge required; the only thing you need is a computer and an internet connection.', 1),
(5, 'UI & Web Design using Adobe Illustrator CC', 'entities/thumbnails/uiai.jpg', 4, 'Build professional web & app designs using Adobe Illustrator CC', 'UI design skills are one of the most employable opportunities of our lifetime. In this course you’ll learn how to design a professional website in Adobe Illustrator CC. We’ll start right at the basics of Illustrator and work our way through to building professional UI designs. This course doesn’t cover how to code a website but focuses on the design processes that professional UI designers use when working.\r\n\r\nThis is a project based class for students who are new to the world of app & web design. I created this for people nervous about changing their careers into the world of user interface design.', 3, '02:00:00', '1', 'English', 'Work as a UI designer building web design & app designs.\r\nUse Illustrator to a professional level.\r\nKnow how to build wireframes.\r\nKnow how to build site maps.', 'You\'ll need a copy of Adobe Illustrator CC 2018 or above. A free trial can be downloaded from Adobe.\r\nNo previous design skills are needed.\r\nNo previous Illustrator skills are needed.', 1),
(6, 'Complete Web Design: from Figma to Webflow to Freelancing', 'entities/thumbnails/complete-web.png', 4, '3 in 1 Course: Learn to design websites with Figma, build with Webflow, and make a living freelancing.\r\n', 'Web Design is fun. It\'s creative.\r\n\r\nIt gives you a huge self-satisfaction when you look at your work and say, \"I made this!\". I love that feeling after I\'m done working on something. When I lean back in my chair, look at the final result with a smile, and have this little \"spark joy\" moment.\r\n\r\nIt\'s especially satisfying when I know I just made $5,000.', 2, '02:00:00', '4', 'English', 'You will learn how to design beautiful websites using Figma, an interface design tool used by designers at Uber, Airbnb and Microsoft.\r\nYou will learn how to take your designs and build them into powerful websites using Webflow, a state-of-the-art site builder used by teams at Adobe, Dell, NASA and more.', 'No requirements. You don\'t have to be creative or good with math. Those are Design and Development myths.', 1),
(7, 'UX & Web Design Master Course: Strategy, Design, Development', 'entities/thumbnails/UX.png', 4, 'Learn how to apply User Experience (UX) principles to your website designs, code a variety of sites, and increase sales!', 'This course will teach you everything you need to know about UX, including design, content, and coding. And you\'ll learn from the ground up, so it doesn\'t matter how much experience you have when you start.\r\n\r\nYou\'ll be exposed to principles and strategies, but, more importantly, you\'ll learn how to actually apply these abstract concepts by coding three different websites for three very different audiences.\r\n\r\nThis course will help you stand out as a web designer, teaching you how to apply User Experience (UX) strategies that will make every site you build useful, usable, and valuable.', 4, '02:00:00', '0', 'English', 'A clear understanding of the principles and benefits of good UX and how to apply it to your website\r\nA strategy for making sure you know what people need from your website, and what you or your client needs from it in order to succeed', 'Need a willingness to learn!\r\nAdobe Photoshop Free Trial version\r\nAxure RP Free Trial version', 1),
(8, 'An Entire MBA in 1 Course:Award Winning Business School Prof', 'entities/thumbnails/an.jpg', 2, '** #1 Best Selling Business Course! ** Everything You Need to Know About Business from Start-up to IPO', 'Are you ready to take your career to the next level? In this course, you will learn everything you need to know about business….from starting a company to taking it public. This course covers all of the important topics you will learn from getting an MBA from a top school + real life practical business concepts that will help make you more successful!\r\n\r\nThis course is taught by an award winning MBA professor with significant real world experience working at Goldman Sachs as well as in the venture capital, hedge fund and consulting industries (he has founded several companies and sits on several boards). Many business concepts are simply common sense. ', 3, '02:00:00', '0', 'English', 'Over 350,000 students in 195 countries!\r\nSuperb reviews!.\r\nFree $99 384 page book version of this course!.\r\nTake your career to the next level!.\r\nLaunch a company from scratch.', 'Nothing except a positive attitude! : )', 1),
(9, 'The Complete Financial Analyst Course 2020', 'entities/thumbnails/the-com-fini.jpg', 2, 'Excel, Accounting, Financial Statement Analysis, Business Analysis, Financial Math, PowerPoint: Everything is Included!', '\"If you’re trying to prepare for an eventual career in finance, but are still looking to round out your knowledge of the subject, The Complete Financial Analyst Course might be a perfect fit for you.\", Business Insider\r\n\r\n\"A Financial Analyst Career is one of the top-paying entry-level jobs on the market.” \r\n\r\n\"Even in the toughest job markets, the best candidates find great positions.\", Forbes\r\n\r\nYou simply have to find a way to acquire practical skills that will give you an edge over the other candidates.\r\n\r\nBut how can you do that?\r\n\r\nYou haven’t had the proper training, and you have never seen how analysts in large firms do their work ...\r\n\r\nStop worrying, please! We are here to help', 4, '02:00:00', '0', 'English', 'Work comfortably with Microsoft Excel.\r\nFormat spreadsheets in a professional way.\r\nBe much faster carrying out regular tasks.\r\nCreate professional charts in Microsoft Excel.\r\nWork with large amounts of data without difficulty.', 'Absolutely no experience is required. \r\nWe will start from the basics and gradually build up your knowledge.\r\nEverything is in the course.\r\nYou will need Microsoft Excel 2010, 2013, 2016, or 2020\r\nYou will need Microsoft PowerPoint 2010, 2013, 2016, or 2020', 1),
(10, 'Tableau 2020 A-Z: Hands-On Tableau Training for Data Science', 'entities/thumbnails/tableau.jpg', 2, 'Learn Tableau 2020 for data science step by step. Real-life data analytics exercises & quizzes included. Learn by doing!', 'Learn data visualization through Tableau 2020 and create opportunities for you or key decision-makers to discover data patterns such as customer purchase behavior, sales trends, or production bottlenecks.\r\n\r\nYou\'ll learn all of the features in Tableau that allow you to explore, experiment with, fix, prepare, and present data easily, quickly, and beautifully.', 5, '02:00:00', '1', 'English', 'Install Tableau Desktop 2020.\r\nConnect Tableau to various Datasets: Excel and CSV files.\r\nCreate Barcharts.\r\nCreate Area Charts.\r\nCreate Maps.\r\nCreate Scatterplots.\r\nCreate Piecharts.', 'Basic knowledge of computers', 1),
(11, 'Beginner to Pro in Excel: Financial Modeling and Valuation', 'entities/thumbnails/excel.jpg', 2, 'Financial Modeling in Excel that would allow you to walk into a job and be a rockstar from day one!', 'Do you want to learn how to use Excel in a real working environment?\r\n\r\nAre you about to graduate from university and start looking for your first job? \r\n\r\nAre you a young professional looking to establish yourself in your new position? \r\n\r\nWould you like to become your team\'s go-to person when it comes to Financial Modeling in Excel? \r\n\r\nIf you answered yes to any of these, then this is the right course for you!', 1, '02:00:00', '0', 'English', 'Master Microsoft Excel and many of its advanced features.\r\nBecome one of the top Excel users in your team.\r\nCarry out regular tasks faster than ever before.', 'Microsoft Excel 2010, Microsoft Excel 2013, Microsoft Excel 2016, or Microsoft Excel 2020', 1),
(12, 'Beginning Project Management: Project Management Level One', 'entities/thumbnails/ppro.jpg', 2, 'Project Management: Growing a Successful Career as a Project Manager', 'Project management is an exciting place to be. Project managers help shape the success of organizations, implement new technology, change the business landscape, and have influence over all areas of a business. Project managers also earn a nice income and often move up the organizational chain into full-time management positions.\r\n\r\nIn this course we’ll examine the absolute basics of project management. Everyone has to start somewhere, right? In this fundamental course we will explore the big picture of project management and the project management life cycle. You’ll finish this course with a great grasp of what project management is, what your roles and responsibilities as a project manager will be, and how to move forward in your career as a project manager.', 2, '02:00:00', '2', 'English', 'Compare and contrast the project management process groups.\r\nExplain what a project is (and is not).\r\nExplain how to initiate a project.\r\nWork with the project team to plan a project.', 'Willingness to learn\r\nAcknowledgement that we all start somewhere\r\nCan-do attitude to finish the course', 1),
(13, 'Project Management Professional (PMP)', 'entities/thumbnails/pmanagmnet.jpg', 2, 'Full Project Management Certification training. Earn all 35 contact hours. Accredited PMI Provider.', 'Welcome to Project Management Professional from LearnSmart.\r\n\r\nLearnSmart is a Project Management Institute (PMI)® Global Registered Education Provider (REP 3577). This course qualifies for the above credit hours toward the PMP® or CAPM® training contact hours or toward earning a certification. Thus meeting the 35 Contact Hours requirement necessary to register for the PMP® exam or for experienced project managers wanting to brush up on their education.', 3, '02:00:00', '1', 'English', 'This course qualifies for 35 Contact Hours toward the PMP® certification from PMI.\r\nPractice for the PMP® Certification Exam.\r\nGain a comprehensive understanding of the Project Management best practices', 'There is not any requirements for this course.\r\nA computer with internet.\r\nIt is helpful to have a basic understanding of and interest in Project Management.', 1),
(14, 'MBA in a Box: Business Lessons from a CEO', 'entities/thumbnails/mbabox.jpg', 2, 'A Complete MBA Training: Business Strategy, Management, Marketing, Accounting, Decision Making & Negotiation', 'For over six months, we worked hard to create the best possible MBA course that will deliver the most value for you. We want you to succeed, which is why the course tries to be as engaging as possible. High-quality animations, superb course materials, a gamebook simulation, quiz questions, handouts and course notes, as well as a glossary with new terms are some of the extra perks you will get by subscribing.  ', 4, '02:00:00', '3', 'English', 'Receive an \'MBA in a Box\' certificate of completion.\r\nAcquire the same business acumen as MBA graduates.\r\nHow to start a company from scratch.\r\nUnderstand how a business functions and what makes a company successful.', 'Absolutely no experience is required. We will start from the basics and gradually build up your knowledge. Everything is in the course.\r\nA willingness to learn and practice.', 1),
(15, 'The Ultimate Drawing Course - Beginner to Advanced', 'entities/thumbnails/ultimate-drawing.jpg', 1, 'Learn the #1 most important building block of all art', 'The Ultimate Drawing Course will show you how to create advanced art that will stand up as professional work. This course will enhance or give you skills in the world of drawing - or your money back\r\n\r\nThe course is your track to obtaining drawing skills like you always knew you should have! Whether for your own projects or to draw for other people.\r\n\r\nThis course will take you from having little knowledge in drawing to creating advanced art and having a deep understanding of drawing fundamentals.', 1, '02:00:00', '1', 'English', 'Draw objects out of your head.\r\nDraw realistic light and shadow.\r\nUnderstand the fundamentals of art.\r\nDraw perspective drawings.\r\nDraw the human face and figure.', 'Paper\r\nPencil\r\nEraser\r\nRuler\r\nMotivation to learn!', 1),
(16, 'Character Art School: Complete Character Drawing Course', 'entities/thumbnails/ch-art.jpg', 1, 'Learn How to Draw People and Character Designs Professionally, Drawing for Animation, Comics, Cartoons, Games and More!', 'Character Art School is a learn-anywhere video course where you learn how to draw professional characters for books, games, animation, manga, comics and more. I’ve hand-crafted the Character Art School: Complete Character Drawing course to be the only course you need to learn all the core fundamentals and advanced techniques to drawing and sketching characters well. If you’re an absolute beginner or you’re already at an intermediate level, the course will advance your current drawing ability to a professional level. The course is a comprehensive 10 module guided video course, where the only limit to your progression is your determination and engagement in the rewarding assignments.', 2, '02:00:00', '1', 'English', 'How to Draw Characters Well.\r\nHow to Draw Out of Your Head Fast.\r\nHow to Draw in 3D.\r\nHow to Draw Faces, Bodies and Hands.\r\nHow to Draw like a Professional Artist.', 'Paper and Pencils or Digital Tools.\r\nMotivation to Learn!.\r\nA Desire to Draw Professionally.', 1),
(17, 'Complete Blender Creator: Learn 3D Modelling for Beginners', 'entities/thumbnails/blender.jpg', 1, 'Use Blender to Create Beautiful 3D models for Video Games, 3D Printing & More. Beginners Level Course', 'Learn how to create 3D Models and Assets for games using Blender, the free-to-use 3D production suite. We start super simple so you\'ll be ok with little or no experience. With our online tutorials, you\'ll be amazed what you can achieve.\r\n\r\nBen Tristem is one of Udemy\'s top instructors, and Michael Bridges is an experienced 3D artist. Together Ben and Michael will provide world-class support, encouragement and plenty of challenges.\r\n\r\nThe course is project-based, so you will applying your new skills immediately to real 3D models. All the project files will be included, as well as additional references and resources - you\'ll never get stuck. There are talking-head videos, powerful diagrams, quality screencasts and more.', 3, '02:00:00', '2', 'English', 'Use Blender and understand it\'s interface.\r\nUnderstand the principles of modelling.\r\nCreate 3D models with simple colors.\r\nLearn the basics of animation.', 'Mac or PC capable of Running Blender Version 2.77 or above', 1),
(18, 'Ultimate Photoshop Training: From Beginner to Pro', 'entities/thumbnails/ps-tranning.jpg', 1, 'Master Photoshop CC 2020 without any previous knowledge with this easy-to-follow course', 'My approach is simple: we focus on real world cases and I present the best techniques that require minimal effort yet produce maximum results. All my content is focused on getting the job done in the least amount of time possible. I\'ll be using the latest version of the program - Photoshop CC 2020, but all the content is explained for all users, no matter what version you have installed. Photoshop Elements is not compatible with this course.  ', 4, '02:00:00', '1', 'English', 'Design icons, business cards, illustrations, and characters.\r\nClean up face imperfections, improve and repair photos.\r\nUse creative effects to design stunning text styles.\r\nRemove people or objects from photos.', 'No previous knowledge of Photoshop required.\r\nIf you have Photoshop installed, that\'s great. If not, I\'ll teach you how to get it on your computer.', 1),
(19, 'Illustrator CC 2020 MasterClass', 'entities/thumbnails/illucc.jpg', 1, 'Master Adobe Illustrator CC with this in-depth training for all levels.', 'This course has been purposely designed for users of all experiences, from complete beginners to existing Illustrator users, who want to take their skills to the next level. Being able to confidently work in Illustrator is an essential skill for any Graphic Designer or Illustrator, but it is an equally useful tool for Product Designers, Fashion Designers, UI/UX designers and various other areas within and outside of the creative industry.', 5, '02:00:00', '0', 'English', 'Designing logos\r\nCreating vector illustrations\r\nTurning photographs into vector artwork\r\nVectorizing and colorizing traced hand drawings', 'Any version of Adobe Illustrator, preferably not older than Illustrator CS6. Ideally Illustrator CC (Creative Cloud).\r\nPrior knowledge is not needed\r\nExercise Files and Study Guides are provided', 1),
(20, 'User Experience Design Essentials - Adobe XD UI UX Design', 'entities/thumbnails/xd.jpg', 1, 'Use XD to get a job in UI Design, User Interface, User Experience design, UX design & Web Design', 'I’m here to help you learn Adobe XD efficiently and comprehensively. XD is a fantastic design tool used by industry professionals to product high quality & functional mockups. By the end of this course, you will be able to produce practical and effective User Experience (UX) and User Interface (UI) designs.\r\n\r\nThroughout the course I’ll invite you to participate in a real-life freelance project which I’m working on. It’s a project that requires a fresh website and mobile app interface. This will prepare you for dealing with real world projects if you choose to move towards a UX/UI career path.', 1, '02:00:00', '2', 'English', 'Become a UX designer.\r\nYou will be able to start earning money from your XD Skills.\r\nYou will be able to add UX designer to your CV.\r\nBuild a UX project from beginning to end.', 'You will need a copy of Adobe XD 2019 or above. A free trial can be downloaded from Adobe.\r\nNo previous design experience is needed.\r\nNo previous Adobe XD skills are needed.', 1),
(21, 'Graphic Design Bootcamp: Photoshop, Illustrator, InDesign', 'entities/thumbnails/gbootcamp.jpg', 1, 'Bestselling Beginner Course! Use Photoshop, Illustrator, & InDesign for logo design, web design, poster design, and more', '· \"This course is good. The tutor is really nice and clear (US accent is alien to me so I sometimes find it difficult to understand - the tutor here is great, doesn\'t speak too fast & is clear, without too many colloquialisms). Enjoying the classes. Feel prepared enough for the purpose I took the course. Would definitely recommend and also do other courses by this tutor\" - Alvira Kiss\r\n\r\n· \"I started this course with little experience and thankfully I have learnt a lot throughout this course. I can\'t wait to learn more about this industry and make my mark on the world and its all thanks to this course which has kickstarted my journey!\" - Charles Vaughn', 2, '02:00:00', '0', 'English', 'Gain a clear understanding of how to work with BOTH print and web projects in Photoshop, Illustrator, and InDesign.\r\nDevelop the skills and confidence to create common graphic design projects.\r\nBuild a skill set that can set you up to be employable in the creative industry as a graphic designer.', 'Be proficient with using a computer, although prior knowledge of any of the Adobe apps is not necessary. However, this is not an “A to Z” course for every bell and whistle that each app provides, but rather a roadmap for how to make awesome projects that people are willing to pay for or that employers are looking for you to have skills with creating.\r\nSome creative skills (drawing, photography, etc.) are helpful and will definitely give you a better chance at becoming successful as a designer, but not required.', 1),
(22, '2020 Complete Python Bootcamp: From Zero to Hero in Python', 'entities/thumbnails/python-boot.jpg', 3, 'Learn Python like a Professional! Start from the basics and go all the way to creating your own applications and games!', 'This is the most comprehensive, yet straight-forward, course for the Python programming language on Udemy! Whether you have never programmed before, already know basic syntax, or want to learn about the advanced features of Python, this course is for you! In this course we will teach you Python 3.\r\n\r\nWith over 100 lectures and more than 21 hours of video this comprehensive course leaves no stone unturned! This course includes quizzes, tests, coding exercises and homework assignments as well as 3 major projects to create a Python project portfolio!', 5, '02:00:00', '0', 'English', 'Learn to use Python professionally, learning both Python 2 and Python 3!\r\nCreate games with Python, like Tic Tac Toe and Blackjack!\r\nLearn advanced Python features, like the collections module and how to work with timestamps!', 'Access to a computer with an internet connection.', 1),
(23, 'Machine Learning A-Z™: Hands-On Python & R In Data Science', 'entities/thumbnails/machine.png', 3, 'Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.', 'Interested in the field of Machine Learning? Then this course is for you!\r\n\r\nThis course has been designed by two professional Data Scientists so that we can share our knowledge and help you learn complex theory, algorithms, and coding libraries in a simple way.\r\n\r\nWe will walk you step-by-step into the World of Machine Learning. With every tutorial, you will develop new skills and improve your understanding of this challenging yet lucrative sub-field of Data Science.', 4, '02:00:00', '2', 'English', 'Master Machine Learning on Python & R\r\nHave a great intuition of many Machine Learning models\r\nMake accurate predictions\r\nMake powerful analysis\r\nMake robust Machine Learning models', 'Just some high school mathematics level.', 1),
(24, 'The Web Developer Bootcamp', 'entities/thumbnails/webbootcamp.jpg', 3, 'The only course you need to learn web development - HTML, CSS, JS, Node, and More!', 'This is the only online course taught by a professional bootcamp instructor.\r\n\r\n94% of my in-person bootcamp students go on to get full-time developer jobs. Most of them are complete beginners when I start working with them.\r\n\r\nThe previous 2 bootcamp programs that I taught cost $14,000 and $21,000.  This course is just as comprehensive but with brand new content for a fraction of the price.\r\n\r\nEverything I cover is up-to-date and relevant to today\'s developer industry. No PHP or other dated technologies. This course does not cut any corners.\r\n\r\nThis is the only complete beginner full-stack developer course that covers NodeJS.\r\n\r\nWe build 13+ projects, including a gigantic production application called YelpCamp. No other course walks you through the creation of such a substantial application.', 2, '02:00:00', '1', 'English', 'Make REAL web applications using cutting-edge technologies\r\nContinue to learn and grow as a developer, long after the course ends\r\nCreate a blog application from scratch using Express, MongoDB, and Semantic UI', 'Have a computer with Internet\r\nBe ready to learn an insane amount of awesome stuff\r\nPrepare to build real web apps!\r\nBrace yourself for stupid jokes about my dog Rusty', 1),
(25, 'Angular - The Complete Guide (2020 Edition)', 'entities/thumbnails/angular.jpg', 3, 'Master Angular 10 (formerly \"Angular 2\") and build awesome, reactive web apps with the successor of Angular.js', 'This course starts from scratch, you neither need to know Angular 1 nor Angular 2!\r\n\r\nAngular 10 simply is the latest version of Angular 2, you will learn this amazing framework from the ground up in this course!\r\n\r\nJoin the most comprehensive, popular and bestselling Angular course on Udemy and benefit not just from a proven course concept but from a huge community as well! \r\n\r\nFrom Setup to Deployment, this course covers it all! You\'ll learn all about Components, Directives, Services, Forms, Http Access, Authentication, Optimizing an Angular App with Modules and Offline Compilation and much more - and in the end: You\'ll learn how to deploy an application!', 3, '02:00:00', '0', 'English', 'Develop modern, complex, responsive and scalable web applications with Angular 10\r\nFully understand the architecture behind an Angular application and how to use it\r\nUse the gained, deep understanding of the Angular fundamentals to quickly establish yourself as a frontend developer', 'NO Angular 1 or Angular 2 knowledge is required!\r\nBasic HTML and CSS knowledge helps, but isn\'t a must-have\r\nPrior TypeScript knowledge also helps but isn\'t necessary to benefit from this course\r\nBasic JavaScript knowledge is required', 1),
(26, 'Complete C# Unity Game Developer 2D', 'entities/thumbnails/c_sharp.jpg', 3, 'Learn Unity in C# & Code Your First Seven 2D Video Games for Web, Mac & PC. The Tutorials Cover Tilemap (35 hours)', 'The course has been remastered in Unity 2018!\r\n\r\nThis course started as a runaway success on Kickstarter and has gone on to become the most popular and most watched Unity game development course on Udemy. The course has full English closed-captions throughout.\r\n\r\nLearn how to create video games using Unity, the world-leading free-to-use game development tool. We start super simple so you need no prior experience of Unity or coding! With our online tutorials, you\'ll be amazed what you can achieve right from the first moment you start the course. ', 2, '02:00:00', '0', 'English', 'Learn C#, a powerful modern language, from scratch. No prior programming experience is necessary.\r\nBecome excellent at using the Unity game engine.\r\nBuild a solid foundation for game design and game development that will help you build your own games.', 'Mac or PC capable of running Unity 2018.\r\nOptional: A free download of Unity 5 to review the original content of the course.\r\nA passion and willingness to learn how to code.', 1),
(27, 'The Complete JavaScript Course 2020: Build Real Projects!', 'entities/thumbnails/js.jpg', 3, 'Master JavaScript with the most complete course! Projects, challenges, quizzes, JavaScript ES6+, OOP, AJAX, Webpack', 'This is a truly complete JavaScript course, that goes beyond what other JavaScript courses out there teach you. \r\n\r\nI will take you from a complete JavaScript beginner to an advanced developer. You will not just learn the JavaScript language itself, you will also learn how to program. How to solve problems. How to structure and organize code using common JavaScript patterns.\r\n\r\nCome with me on a journey with the goal of truly understanding the JavaScript language. And I explain everything on the way with great detail!\r\n\r\nYou will learn \"why\" something works in JavaScript, not just \"how\". Because in the modern JavaScript world of today, you need more than just knowing how something works. You need to debug code, you need to understand code, you need to be able to think about code.', 5, '02:00:00', '1', 'English', 'Go from a total beginner to an advanced JavaScript developer\r\nCode 3 beautiful real-world apps with both ES5 and ES6+ (no boring toy apps here)\r\nJavaScript and programming fundamentals: variables, boolean logic, if/else, loops, functions, arrays, etc.\r\nComplex features like the \'this\' keyword, function constructors, prototypal inheritance, first-class functions, closures\r\n', 'No coding experience is necessary to take this course! I take you from beginner to expert!\r\nAny computer and OS will work — Windows, macOS or Linux. We will set up your text editor the course.\r\nA basic understanding of HTML and CSS is a plus, but not a must! The course includes a 5-minutes HTML and CSS crash course.', 1),
(28, 'Unreal Engine C++ Developer: Learn C++ and Make Video Games', 'entities/thumbnails/cpp.jpg', 3, 'Created in collaboration with Epic Games. Learn C++ from basics while making your first 4 video games in Unreal', 'The course has been fully updated and remastered to Unreal Engine 4.22+. Existing students get all the new material for free.\r\n\r\nGet plugged into our communities of amazing developers on Facebook (nearly 20k), in our own TA-curated Community (17k views/day), and our student chat group (10k live at any one time).\r\n\r\nThe course now has high-quality handwritten subtitles throughout, available as closed captions so you can turn them on or off at your convenience. This is one of the best Unreal Engine tutorials on the web.\r\n\r\nThis course started as a runaway success on Kickstarter. Get involved now, and get access to all future content as it\'s added. The final course will be over 50 hours of content and 300+ lectures.', 2, '02:00:00', '0', 'English', 'C++, the games industry standard language.\r\nHow to use the Unreal Engine 4 Editor.\r\nGit as a version control and backup system.\r\nObject Oriented Programming and how to put it into practice.\r\nSound effects and audio to add depth to your games.', '64-bit PC capable of running Unreal 4 (recommended).\r\nOr a Mac running MacOS 10.14 Mojave or higher\r\nAbout 15GB of free disc space.', 1),
(29, 'Photography Masterclass: A Complete Guide to Photography', 'entities/thumbnails/photomm.jpg', 5, 'The Best Online Professional Photography Class: How to Take Amazing Photos for Beginners & Advanced Photographers', 'This online photography course will teach you how to take amazing images and even sell them, whether you use a smartphone, mirrorless or DSLR camera.\r\n\r\nThis photography course is designed to teach you the ins and outs of photography, even if you have little to no experience with it, to help create profitable images that help you stand out from the crowd and sell.\r\n\r\nMaster Photography Techniques to Create Extraordinary Images!\r\n\r\nWhile there are plenty of digital photography courses that focus on specific styles or how to use gear, it\'s hard to find a comprehensive course like this one, which is for beginner to advanced photographers.', 1, '02:00:00', '0', 'English', 'You will know how to take amazing photos that impress your family and friends\r\nYou will know how the camera truly works, so you can take better photos using manual settings\r\nYou will know how to photograph in different scenarios like family portraits, landscapes, aerial, product, wildlife, and much more', 'You should be excited to learn photography, and ready to take action!\r\nNo fancy camera is required, having camera (even a smartphone) will help you learn as we prompt you with practice activities.\r\nNo prior knowledge of photography is required - this course is geared for absolute beginners.', 1),
(30, 'Premiere Pro CC for Beginners: Video Editing in Premiere', 'entities/thumbnails/prcc.jpg', 5, 'Learn how to edit videos in Adobe Premiere Pro with these easy-to-follow Premiere Pro video editing tutorials.', 'If you are looking for a video editing application that will allow you to edit videos however you want them, Adobe Premiere Pro is the best answer.\r\nPremiere Pro is used by professionals across the world for every type of production from business & marketing videos, music videos to documentaries, feature films.\r\nThis full course is the best way to jump right in and start editing.\r\nMake videos the way you imagine them!\r\n\r\nPractice editing while you learn. This course includes practice video files so you can follow along and actually learn by doing.\r\n\r\nBy the end of the course, you\'ll have edited a 1-minute documentary with the supplied footage.\r\n\r\nI\'ll be teaching the course using the creative cloud version, but if you have a previous version (CS6, CS5, CS4, CS3 - Mac or PC), you can still learn to edit like a pro.', 2, '02:00:00', '0', 'English', 'Includes CC 2020 Updates!\r\nEdit an entire video from beginning to end, using professional and efficient techniques.\r\nBy the end of the course, you\'ll have edited your own short documentary using either the supplied footage (video clips, photos, graphics, music, etc.), or your own footage!\r\nStart a project with the right settings for any type of video, from any camera.', 'Students should have Adobe Premiere Pro installed on their computers to follow along.\r\nThere are A LOT OF PRACTICE EXERCISES throughout this course with downloadable practice clips. We want you to follow along.\r\nWe teach this course using the Adobe Premiere Pro CC (creative cloud) versions, so it would be best if you\'re using CC.\r\nBut you can still learn using CS6, CS5, CS4, or even CS3!', 1),
(31, 'The Complete Video Production Bootcamp', 'entities/thumbnails/video.jpg', 5, 'Make better videos with the ultimate course on video production, planning, cinematography, editing & distribution.', 'Whether you\'re a YouTuber, blogger, vlogger, business owner, aspiring filmmaker, or just someone who wants to create videos, you will learn how to make professional videos with this course.\r\n\r\nMaster Video Production Techniques to Create Amazing Videos that Boost Your Views, Revenue and Drive Traffic To Your Business\r\n\r\nWhile there are plenty of tutorials and courses that focus on specific cameras or styles, it\'s hard to find a comprehensive course like this one, which covers everything from coming up with great video ideas, executing them in production and post-production, and distributing them to a wide audience online.', 3, '02:00:00', '0', 'English', 'You\'ll create professional videos with the equipment you already have\r\nYou\'ll feel comfortable making your own videos from conception and production to editing and posting online.\r\nDownloadable guides to help you with every section\r\nYou\'ll know what equipment we suggest for beginner video creators.', 'This course is put together for completely new video creators. While having any type of video experience will help, it is not necessary.\r\nHaving any type of camera that shoots video (smart phones, DSLR, point and shoot, webcam) will help as we encourage to you complete our practice exercises throughout the course.', 1),
(32, 'iPhone Photography | Take Professional Photos On Your iPhone', 'entities/thumbnails/iphone.jpg', 5, 'Your Online Guide to Taking Stunning iPhone Photography Like a Professional Digital Photographer', 'This online photography course will teach you everything you need to know to become a professional digital photographer with nothing more than an iPhone or similar smartphone. It is designed to keep you engaged and hone your skills for taking your pictures to the next level. \r\n\r\nMy #1 rule in photography is 10% gear / 90% knowledge. So if you know HOW to be a great photographer and know what to look for, you will be able to take amazing pictures with almost anything.\r\n\r\nThis course is designed for:\r\n\r\n-Beginners that have little to no experience and want to become a skilled photographer without spending thousands of dollars on expensive camera equipment.\r\n\r\n-Anyone that wants to develop a more impressive portfolio or social media account (i.e. Instagram).\r\n\r\n-Anyone that wants to make professional digital photography into an exciting career. ', 4, '02:00:00', '0', 'English', 'How to replicate professional digital photography with your iPhone.\r\nHow to take stunning photos by utilizing shot composition.\r\nHow to optimize iPhone settings for taking the best photos.', 'All you need is access to an iPhone or other smartphone with a camera. Thats it!', 1),
(33, 'Complete Filmmaker Guide: Become an Incredible Video Creator', 'entities/thumbnails/film.jpg', 5, 'Get 7 Years of Filmmaking Experience - Everything from Pre-Production to Editing - in 5 Hours', 'This filmmaking course covers all the creative aspects of planning, shooting, and editing an incredible video. \r\n\r\nIf you are a beginner, youtuber, or filmmaker looking to successfully create awesome videos, then this course is made for you.\r\n\r\n\r\n1. Creative & Personal Skill Development ', 5, '02:00:00', '0', 'English', 'Complete mastery over lenses, lighting, sound recording, cinematography, and editing!\r\nCreate your own incredible videos from scratch with a brand new understanding of filmmaking!\r\nUnderstand timeless video principles that will stay with you in all projects, forever!', 'You should be an aspiring creative wanting to create incredible videos!\r\nYou should have a beginning or moderate understanding of shooting and editing\r\nYou should have a camera and video editing software', 1),
(34, 'Night Photography: You Can Shoot Stunning Night Photos', 'entities/thumbnails/night.jpg', 5, 'You will shoot amazing night photos that impress your family and friends with this complete night photography course!', 'YOU CAN TAKE BEAUTIFUL NIGHT PHOTOS!\r\n\r\nThat\'s why you\'re here right? \r\n\r\nWe\'re excited to show you how to take your own amazing night & low-light photos.\r\n\r\nWith this complete night photography course, you\'ll learn the ins and outs from the gear we recommend, the settings we use, the composition tips we have, and the photo editing process we use to end up with award-winning night photos.\r\n\r\nFollow us as we head out to Joshua Tree National Park to teach this night photography course!\r\n\r\nIn this course we combine entertainment + education in this complete behind-the-scenes course. We\'re not just sitting behind our computer desk, showing you slides. We\'re out in the field, showing you exactly what we do to shoot our own night photos.', 2, '02:00:00', '0', 'English', 'You will learn how to take beautiful night photographs - like the pros!\r\nYou will be happier with the photos you shoot than ever before!\r\nYou will learn how to shoot light trail photos with your camera\r\nYou will know how to use Bulb mode and a shutter release remote to shoot long exposures', 'While this course was created for beginner photographers, it would be beneficial for you to understand basic photography concepts such as aperture, shutter speed, and ISO. We have included a refresher lesson that will get you up to speed if you need it.\r\nThis is a great follow up to our Photography Masterclass, which will get you up to speed to dive right into this course.\r\nYou can use any camera to take great night photos. We\'ll be using Canon, Nikon, Leica, and Fujifilm DSLR and Mirrorless cameras + smartphones like the iPhone', 1),
(35, 'Mastering Architecture and Real Estate Photography', 'entities/thumbnails/master.jpg', 5, 'Start a business photographing real estate photography jobs for architects, builders, and real estate agents', 'Photoshop is used widely in the course and while you do not need to be an expert, some familiarity (primarily Layer Masking techniques} will make it easier for you. But if you are not that familiar with Photoshop, don\'t worry, we have some introductory Photoshop videos that will guide you along the way. \r\n\r\n You will need a digital camera with a wide-angle lens. For full-frame sensor cameras a lens around 16-35 is perfect and if you have a cropped APS sensor camera then a wide-angle lens around 10-20 will work as well. If you don\'t have lenses in that range but do have a wide-angle lens then use it for the course and learn what you need for later purchase. You need a good tripod and a cable release or wireless device to trigger your camera. I also recommend wireless triggers to fire the strobe/flashes. \r\n\r\n This course covers lighting extensively and includes several techniques. You will learn how to shoot architecture without lights, with strobes and umbrellas, also with a flash unit.', 1, '02:00:00', '0', 'English', 'Learn a variety of techniques to photograph architecture and real estate properties.\r\nHow to find the best angle, light, and composition\r\nHow to light with flash or strobe lights\r\nHow to understand and fix bad color', 'An intermediate understanding of photography techniques\r\nCamera, wide angle lens, tripod, cable release or wireless camera trigger.\r\nPhotoshop is demonstrated throughout the course and an intermediate understanding is helpful. You do not have to use Photoshop and can use other programs if they will allow compositing of images.\r\nThe use of flash or strobes is covered but owning that equipment is not required.', 1),
(145, 'PianoPianoforall - Incredible New Way To Learn Piano & Keyboard', 'entities/thumbnails/piano.jpg', 6, 'Learn Piano in WEEKS not years. Play-By-Ear & learn to Read Music. Pop, Blues, Jazz, Ballads, Improvisation, Classical', 'Pianoforall is one of the most popular online piano courses with over 300,000 students worldwide\r\n\r\nNow ANYONE Can Learn Piano or Keyboard\r\n\r\n             Imagine being able to sit down at a piano and just PLAY - Ballads,  Pop, Blues, Jazz, Ragtime, even amazing Classical pieces? Now you can...  and you can do it in months not years without wasting money, time and  effort on traditional Piano Lessons. ', 2, '02:00:00', '0', 'English', 'Pianoforall will take complete beginners to an intermediate level in a very short space of time\r\nYou get to sound like a pro right from the start\r\nYou will learn the absolute basic essential techniques that will allow you to play any song in any style - by ear!\r\nYou will learn to read sheet music AS you learn to play-by-ear', 'You don\'t need any prior knowledge or experience\r\nPianoforall works equally well on Piano or Keyboard\r\nYou only need to practice 20 minutes a day to make rapid progress', 1),
(146, 'Complete Guitar System - Beginner to Advanced', 'entities/thumbnails/guitar.jpg', 6, 'All-in-one Guitar Course With a Proven Step-by-step Learning System.', 'Lectures/Videos with PDF Attachments\r\n34 hours of video\r\nIt\'s available on a PC or MAC and there is a iPad, iPhone and Android app ready to go! \r\nKeeping track of which videos(lectures) you have already watched is a breeze. Udemy has a great way of keeping track of your completed lessons(lectures).', 1, '02:00:00', '0', 'English', 'New to Guitar? This Will be the Only Course You Will Ever Need to Take\r\nHave You Playing the Guitar in the Shortest Amount of Time While Having the Most Fun\r\nMost Logical Step-by-step Method to Play Songs and Master Chords, Scales and Guitar Theory\r\nExercises That Will Sharpen Your Chord Transitioning, Strumming, Fretting, Picking, and Fingerpicking', 'No Special Skills Needed\r\nYou Will Need a Guitar\r\nPractice Can Not Be Avoided', 1),
(147, 'Music Theory Comprehensive Complete! (Levels 1, 2, & 3)', 'entities/thumbnails/music.jpg', 6, 'A Complete College-Level Music Theory Curriculum. This edition of the course includes levels 1, 2, & 3.', 'For years I\'ve been teaching Music Theory in the college classroom. These classes I\'m making for Udemy use the same syllabus I\'ve used in my college classes for years, at a fraction of the cost. I believe anyone can learn Music Theory - and cost shouldn\'t be a barrier.\r\n\r\nMy approach to music theory is to minimize the memorization. Most of these concepts you can learn by just understanding why chords behave in certain ways. Once you understand those concepts, you can find any scale, key, or chord that exists. Even invent your own. If you\'ve tried to learn music theory before, or if you are just starting out - this series of courses is the perfect fit.', 3, '02:00:00', '0', 'English', 'Read Music Using Proven Techniques\r\nUnderstand All the Symbols (Not Only the Notes) of a Music Score\r\nRead, Play, and Count Rhythms Accurately\r\nThe elements of the Score\r\nPitch Names\r\nPitch Classes\r\nOctaves\r\nThe White Keys\r\nThe Black Keys (not the band!)\r\nHalf-Steps and Whole-Steps\r\nClefs\r\nIntervals', 'Students should be enthusiastic about music, but do not need to be producers or musicians. No prior experience is needed in music - All are welcome!\r\nI\'ll be using a piece of software in this course that I would like students to get. Don\'t worry - it\'s free! And works on Mac and PC programs. I\'ll tell you more in the first few videos.', 1);
INSERT INTO `entities` (`id`, `name`, `thumbnail`, `categoryId`, `short_des`, `long_des`, `teacherid`, `duration`, `student_en`, `language`, `overview`, `requirmnet`, `status`) VALUES
(148, 'Music + Audio Production in Logic Pro X - The Complete Guide', 'entities/thumbnails/maudio.jpg', 6, 'Become a master at using Logic Pro X | Understand music production | Learn to record, edit & mix audio to a pro standard', 'This course IS for anyone who wants to produce their own music.\r\nThis course IS for anyone who wants to record and edit audio.\r\nThis course IS for voice over actors, dialogue editors and general audio engineers.\r\nThis course IS for anyone who wants to mix music in Logic Pro X.\r\nThis course IS for anyone who wants to record and mix music at home.\r\nThis course IS for professional engineers seeking to expand their knowledge of Logic Pro X.\r\nThis course IS for absolute beginners who have never recorded or produced audio.', 4, '02:00:00', '0', 'English', 'Learn how to record and edit audio to a professional standard in less time than any other DAW (because Logic Pro is super easy to use).\r\nConsistently produce mixes that sound clear, powerful, and professional by following my step-by-step mixing system using stock plugins.\r\nWrite more music and edit more audio in less time by learning the little-known features of Logic Pro that will significantly speed up your workflow.', 'You can still enroll in this course even if you don\'t yet own a copy of Logic Pro X.\r\nYou will need a computer capable of running Logic Pro X.\r\nYou will need an internet connection to watch this videos.', 1),
(149, 'Music Production in Logic Pro X - The Complete Course!', 'entities/thumbnails/logicpro.jpg', 6, 'Join Successful Music Production + Logic Pro X students in Creating, Recording, Mixing Music + Mastering in Logic Pro X', 'This course is all about Music Production in Logic Pro X, which is a software for music composition and production for OS X\r\n\r\nWith over 50-hours of video, this music course is JAM PACKED with information to help you learn Logic Pro X and help you improve at Music Production\r\n\r\nLogic Pro X is the leading Digital Audio Work Station for Apple Mac users and it\'s used across professional studios and bedrooms worldwide. Learning how to use your DAW correctly will dramatically improve the quality of your music and the speed you create it', 5, '02:00:00', '0', 'English', 'Learn how to set-up and navigate around Logic Pro X so you can learn to use this amazing piece of softare\r\nImport and search Apple Loops to easily help you create you own music\r\nBe able to record and edit MIDI Information easily and Quickly in Logic Pro X', 'Basic Music Skills\r\nA Working Mac or MacBook\r\nLogic Pro X Software\r\nBasic Music Production Skills is desirable, but not necessary', 1),
(150, 'Learn to play HARMONICA, the easiest instrument to pick up!', 'entities/thumbnails/harmonic.jpg', 6, 'Ultimate diatonic harmonica lessons, blues, country music, rock; you will learn how to play on/off stage, solo/group', 'I think people recognise my passion for the harmonica. I’m not someone who plays bass, guitar, piano, drums and sings, records, gigs…I just (mostly) teach harmonica.\r\n\r\nSure I perform sometimes, gig with friends, go to jams, do corporate harp demonstrations but MOSTLY I focus on playing, learning and teaching harmonica.\r\n\r\nSo if you have a Hohner harmonica, a blues harmonica, hohner special 20, a chromatic harmonica (ok, not that one) a blues harp, a hohner big river, a harmonica holder, a harmonica set…you can start to play now.\r\n\r\nGive me a shout if you need any help please.', 1, '02:00:00', '0', 'English', 'how to play the 12 bar blues, chords, rhythms, tone and chugging\r\nhow to breathe properly, use straight and swing rhythms\r\nhow to play single notes with pucker and tongue-blocked embouchures\r\nscales, modes and positions, single/double/triple tonguing\r\nhow to use major and minor pentatonic scales for improvising and soloing', 'All you need is a 10 hole diatonic harmonica in the key of C.\r\nEven if you\'ve been told you are musically hopeless you can play harmonica! The famous harp slinger Lee Oskar was told that at school!\r\nYou don\'t need any previous musical experience\r\nTone deaf? no problem! You can play harmonica.', 1),
(151, 'Music Theory for Electronic Music COMPLETE: Parts 1, 2, & 3', 'entities/thumbnails/elect.jpg', 6, 'Electronic music theory, digital music theory, and dance music theory. Learn music theory with ableton live and more!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.', 2, '02:00:00', '0', 'English', 'By the end of this course, you will have improved your tracks by understanding how to build chords and melodies that work together.\r\nUnderstand and apply minor chords\r\nUse the circle of fifths to generate new ideas for your own tracks\r\nWork within minor keys to write compelling melodies and basslines\r\nThe Piano Roll editor', 'Students should be enthusiastic about music, but do not need to be producers or musicians. No prior experience is needed in music theory, production, or recording.\r\nAccess to a DAW: any program will do. (GarageBand, Logic, Pro Tools, Ardour, FL Studio, Ableton Live, etc.)\r\nAlthough Ableton Live is used in the class, students do not need to be Live users. But they should have access to some kind of audio program with MIDI sequencing. Garageband, Logic, or several free pieces of software all work great.', 1),
(152, 'The Complete Digital Marketing Course - 12 Courses in 1', 'entities/thumbnails/digi.png', 7, 'Master Digital Marketing Strategy, Social Media Marketing, SEO, YouTube, Email, Facebook Marketing, Analytics & More!', 'With over 20 hours of training, quizzes and practical steps you can follow - this is one of the most comprehensive digital marketing courses available. We\'ll cover SEO, YouTube Marketing, Facebook Marketing, Google Adwords, Google Analytics and more!\r\n\r\nLearn By Doing\r\n\r\nThe course is hugely interactive with projects, checklists & actionable lectures built into every section.\r\n\r\nLearn step by step how to market a business online from scratch across all the major marketing channels.', 2, '02:00:00', '0', 'English', 'Grow a Business Online From Scratch\r\nMake Money as an Affiliate Marketer\r\nLand a High-Paying Job in Digital Marketing\r\nWork From Home as a Freelance Marketer', 'No experience required\r\nSuitable for all types of businesses (digital product, physical product, service, B2B, B2C).', 1),
(153, 'Ultimate Google Ads Training 2020: Profit with Pay Per Click', 'entities/thumbnails/gads.jpg', 7, 'Google Ads 2020: How our clients have transformed their sales using Google Ads & get your Google Ads certification!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.', 1, '02:00:00', '0', 'English', 'Drive Consistent, Round-The-Clock Traffic To Your Website or Landing Page\r\nUse Conversion Tracking To Determine The Value Of Your Ad Campaigns\r\nCreate, Develop and Optimize Your Own Profitable Google AdWords Campaigns\r\nRemarket to Your Previous Website Visitors To Get Them Coming Back To Your Site', 'For This Google AdWords Course you should have a website, landing page or Facebook page that you want to send traffic to.\r\nBUT even if you don\'t have a landing page or website yet, you should still enroll in this AdWords course to become an expert in pay per click advertising\r\nAll you need is a laptop, tablet or smartphone with an internet connection!\r\nNO experience with AdWords required!', 1),
(156, 'Facebook Ads & Facebook Marketing MASTERY 2020 | Coursenvy ®', 'entities/thumbnails/fb.jpg', 7, 'Facebook Marketing from beginner to advanced! Join 100,000+ students who MASTERED Facebook and are Facebook Ads experts!', 'Want to become a Facebook Ads expert? JOIN THE 500+ COMPANIES I HAVE CONSULTED ON SOCIAL MEDIA MARKETING AND INCREASED CONVERSIONS FOR VIA FACEBOOK AND INSTAGRAM ADS! Facebook Marketing is a REQUIRED skill for anyone with a business, product, service, brand, or public figure they need to PROMOTE! Join our 300,000+ modMBA students who have MASTERED Facebook advertising with this COMPLETE Facebook Marketing Mastery Course! ', 3, '02:00:00', '1', 'English', 'Connect with new audiences and lower your ad costs via Facebook Ads!\r\nMass post quickly to various social media networks!\r\nMASTER Facebook Ads Manager!\r\nImplement the Facebook Pixel and advanced tracking strategies.\r\nMASTER your sales funnel... awareness, retargeting, and conversion!', 'Have a personal profile/account on Facebook.', 1),
(157, 'Instagram Marketing 2020: Complete Guide To Instagram Growth', 'entities/thumbnails/insta.png', 7, 'Attract Hyper-Targeted Instagram Followers, Convert Followers to Paying Customers, & Expand your Brand Using Instagram', 'Instagram is a powerful and fun social tool that allows you to market your business to hundreds of new customers everyday! There are over 1 Billion Instagram users, and learning simple strategies to gain targeted followers can significantly increase your businesses revenue.', 5, '02:00:00', '0', 'English', 'Have a powerful Instagram account setup for your Business or personal that you can build your brand and convert your followers into paying customers.\r\nAttract 10,000 real targeted followers to your Instagram account!\r\nConvert your new Instagram followers to long-term loyal paying customers who love your business!', 'You should download Instagram onto a mobile device.', 1),
(158, 'Social Media Marketing MASTERY | Learn Ads on 10+ Platforms', 'entities/thumbnails/social.png', 7, 'MASTER online marketing on Twitter, Pinterest, Instagram, YouTube, Facebook, Google and more ad platforms! Coursenvy ®', 'If you want to be successful with Social Media Marketing you will LOVE this Udemy course! You will learn the principles and strategies that work for us and that we have used to build highly converting ads for over 500+ businesses and clients successfully! Facebook, Twitter, Instagram, Pinterest, Google, YouTube, LinkedIn, Tumblr, Wordpress, Blogger... any marketing via social media, we have you covered with this top-rated course! Stop wasting your money blindly running ads. MASTER paid online marketing once and for all! The optimization of your social media accounts is a REQUIRED skill for ALL marketers and business owners. TAKE ACTION and learn social media marketing on 10+ platforms starting today!', 4, '02:00:00', '0', 'English', 'Understand everything about Social Media Marketing!\r\nCreate highly optimized and high quality paid ads on all Social Media platforms.\r\nLearn Instagram Marketing A-Z and how to monetize the social platform.\r\nLearn Twitter Marketing strategies for LASER focused ads.\r\nMASTER YouTube marketing, including: layout, content creation, and video ads!', 'Ask me ANY questions in the discussion section, I\'m here to help you master Social Media Marketing!\r\nA desire to grow your businesses via Social Media Marketing!', 1),
(159, 'Google Analytics Certification: Become Certified & Earn More', 'entities/thumbnails/certi.jpg', 7, 'Become Google Analytics Certified to Land a Job, Get Promoted or Start a Whole New Career! 2020 Guide', 'Anyone Who Wants to Thrive in this New Data Driven Economy\r\nRecent Graduates Who Want a Secure More Interviews by Proving They Have in-demand Skills\r\nSEO & PPC Specialist Who Want to Separate Themselves From the Competition\r\nMarketing People who Want to Leverage Marketing Analytics Within Their Role\r\nWebsite Owners Who Want to Take Their Analytics (and business!) to the Next Level\r\nAgencies Who Want to Train Up Staff Members Quickly', 2, '02:00:00', '1', 'English', 'No previous experience required', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.', 1),
(160, 'SQL for Data Analysis: Weekender Crash Course for Beginners', 'entities/thumbnails/sql.jpg', 7, 'Using MySQL but applicable to Oracle SQL, Microsoft SQL Server, and PostgreSQL. Taught by a Data Scientist and PM.', 'This SQL course has been taken by fine marketing folks at Google, Facebook, Amazon, Lyft, and Udemy.\r\n\r\nYour Story:\r\n\r\nBill was looking to move into a more analytical role and saw SQL as a requirement in the job listings he saw.  He wanted to add \"SQL\" as a skill to his resume/CV with a clean conscience and back it up if any questions arose in the interview.  But getting there would take forever. Better to just \"fake it til\' you make it\"... right?\r\n\r\nJoe was working in a marketing position at a small company. He had a bunch of creative ideas but sometimes felt like he was shooting in the dark and guessing at what customers were doing. If only he had some insights about user behavior so he could be a more data-driven marketer. But data analysis is only for technical folks… right', 1, '02:00:00', '1', 'English', 'Analyze user behavior\r\nFind actionable customer/business insights\r\nMake data-driven decisions\r\nMeasure and track marketing efforts\r\nDiscover sexy marketing stats (e.g. 1 in 4 people love toast!)', 'No previous technical knowledge required', 1),
(161, 'After Effects CC 2020: Complete Course from Novice to Expert', 'entities/thumbnails/afcc.jpg', 8, 'Create stunning Motion Graphics, VFX Visual Effects & VFX Compositing with hands-on tutorials & 50+ practice projects.', 'The latest Responsive Design Techniques (CC 2020)\r\n\r\nCreate your First Motion Graphics Video\r\n\r\nHow to Design and Animate a full AE Project\r\n\r\nSpatial and Temporal Interpolation and Motion Path Animation\r\n\r\nReveal Techniques using Track Mattes and Masks\r\n\r\nImportant Techniques to Help You Create even better animation\r\n\r\nEssential 3D Animation Techniques\r\n\r\nAdvanced 3D with Cameras, Lights and Shadows\r\n\r\n3D Camera Orbit Null\r\n\r\nComplex, Compound and Bezier Shapes', 3, '02:00:00', '0', 'English', 'How to use all of After Effects CC - in a dynamic, hands on approach.\r\nWork with the latest Responsive Design Techniques\r\nCreate Motion Graphics to enhance your videos using a step by step, easy-to-use method.\r\nBoost your creativity by completing 50+ Practice Activities and projects from simple to complex.', 'No Prior Knowledge of After Effects, Visual Effects or Motion Graphics Required\r\nA working copy of After Effects CC 2020 or CC 2019\r\nAll project files are available in After Effects CC 2020, CC 2019 and CC 2018\r\nBackward compatibility up to After Effects CC 2013 for all projects', 1),
(162, 'Creating 3D environments in Blender', 'entities/thumbnails/crblender.jpg', 8, 'This course helps you creating wonderful environment scenes, organizing your workflow, and find the right inspiration.', 'After four years, the creating 3D environments course, is now finally here for Blender 2.81. Thousands of students participated in the first version of this course and there were a lot of requests for a follow-up course. Prepare for a new chapter in the world of 3D environments!\r\n\r\nThe profession continues\r\n\r\nFor centuries, making environments has been something that many artists do to impress other people. Since the advent of computer graphics there is a new wave of designers studying this lovely profession. This course reveals some fundamental lessons from the old painting masters. Use the course to get the max out Blender and learn to create high quality 3D environments.', 2, '02:00:00', '0', 'English', 'Creating stunning unique environments\r\nOrganize your workflow to make large environment scenes\r\nMore than 250 unique 2K / 4K textures\r\nLots of medieval reference photos\r\nE-book: Old Masters Unveiled ( 250 pages)\r\nAll scene assets, including buildings, rocks, grass, trees and more\r\n6 Characters to fill up your scene', 'Blender version 2.81 or above\r\nComputer ( min 16GB ram)', 1),
(163, 'After Effects - Motion Graphics & Data Visualization', 'entities/thumbnails/afef.jpg', 8, 'Using Adobe After Effects create beautiful VFX Visual Effects, data visualization & VFX Compositing.', 'This course is for beginners. You don’t need any previous knowledge in VFX Compositing or any motion graphics experience. We’ll start with the super basics, taking simple icons breathing life into to them with After Effects.\r\n\r\nWe’ll work through a real life projects, connecting Excel into After Effects to transform your boring spreadsheet data into approachable visual information. We’ll experiment with lighting & cameras. We’ll do some fun things with masking, looking at how important sound is in your presentation, all the way through to exporting for Youtube, Powerpoint and all sorts of social media including animated GIFS.  ', 4, '02:00:00', '0', 'English', 'You\'ll learn to take Excel spread sheets and animate this in After Effects.\r\nYou’ll learn how to make animated pie charts, line charts & bar graphs.\r\nYou’ll learn how to create percentage counters.\r\nYou’ll learn how to animate icons making beautiful infographics.\r\nYou’ll learn how to create \'voice over\' infographics.', 'You will need a copy of Adobe After Effects, Illustrator & Photoshop CC 2017 or above. 90% of the course will be done in After Effects but a few things are better done in Illustrator & Photoshop. A free trial can be downloaded from Adobe.\r\nNo previous motion graphic skills are needed.\r\nNo previous After Effects, Illustrator or Photoshop skills are needed.', 1),
(164, 'Maya for Beginners: Complete Guide to 3D Animation in Maya', 'entities/thumbnails/myay.jpg', 8, 'Learn everything you need for 3D animation in Autodesk Maya: Modeling, Texturing, Lighting, Rigging, Animation, Dynamics', 'You can do your own 3D animations in Autodesk Maya!\r\n\r\nLearn everything you need to know to get started - taught by a Hollywood professional!\r\n\r\nAs the industry standard 3D animation software, learning Autodesk Maya is a great skill to help you land a job in the film, music and gaming industry. In this course, you\'ll learn how to create your entire animation from scratch. ', 5, '02:00:00', '0', 'English', 'You will become comfortable using Autodesk Maya to model, texture, rig, animate, dynamics, light, and render\r\nBuild and design your own 3D objects\r\nAnimate your 3D objects with keyframes\r\nModeling, shading, texturing, lighting beautiful designs\r\nRendering your projects for high quality playback', 'You should have Autodesk Maya to follow along with the course\r\nAutodesk provides a free 3-year educational version of Maya from their website\r\n3-button mouse', 1),
(165, 'Learn 3D Animation - The Ultimate Blender Guide', 'entities/thumbnails/learn3d.jpg', 8, 'A-Z Guide to Learning 3D Animation and Modeling With Blender to Set You on Your Way to Creating Awesome 3D Artwork', 'Learn the A-Z\'s that you need to be able to create amazing 3D art and animations with the popular 3D art program, \"Blender.\"\r\n\r\nBeginner to the world of 3D? No problem! In this course we go from A-Z, from the basics to the more advanced of 3D creation. This course is project based so we will be using the skills we learn along the way to create some awesome artwork and animations. On top of that, we\'re going to have fun and end each video in a positive way that will leave us ready for whatever Blender or life throws at us!', 3, '02:00:00', '0', 'English', 'At the end of my course, students will know the basics and the more advanced skills to masterfully navigate and create their own works of 3D art\r\nAt the end of my course, students will feel confident navigating around Blender and the different tools to use and what they do\r\nAt the end of my course, students will be able to create their own characters and animation scenes and know all the different steps that it takes to go from nothing to a fully finished animation project.', 'All you need to do before is down Blender which is free and then bring your mouse and keyboard and join me on this adventure!\r\nYou can download GIMP which is a free photo editing software or use Photoshop or another software that you might have', 1),
(166, 'Designing for 3D Printing with Fusion 360', 'entities/thumbnails/d3d.jpg', 8, 'Learn to design for 3D printing with my easy to follow video lessons using Fusion 360', 'The real magic in 3D printing happens when you are able to create your own designs.  We will learn how to use Autodesk Fusion 360 to design ten practical and functional products that can be 3D printed.  Each lesson will build on the prior to introduce design concepts and best practices when when designing for desktop 3D printers.  Fusion 360 is free for students and hobbyists and is a very powerful designing tool.  By the end of the course you will have the skills and confidence to begin creating your own designs and start turning your ideas into physical objects.', 2, '02:00:00', '0', 'English', 'Learn the skills to design your own models for 3D printing using Autodesk Fusion 360, a very powerful and free software for 3D design.', 'The course is geared for beginners. No prior knowledge in 3D design necessary', 1),
(167, '3ds Max + V-Ray: 3ds Max PRO in 6 hrs', 'entities/thumbnails/max.jpg', 8, '3ds Max intro course: 3Ds Max and V-Ray for creating 3D architectural imagery, from beginner to advanced', '*Much more content coming soon (advanced techniques for arch viz, interior renderings with V-Ray, animation, etc)\r\n\r\n*I\'ll be your technical support - I answer questions every day in the discussion area, and I always respond to your private messages.  In these advanced computer programs, you will inevitably run into technical problems.  I am always here to answer all your questions and help you troubleshoot.  You can\'t find another course anywhere that gives you this much training, from a practicing professional, who is also at your beckon call to help, for such a reasonable price. ', 1, '02:00:00', '0', 'English', 'Learn 3ds Max + V-Ray from scratch by creating your first arch viz project in the first 6 hrs of the course\r\nTake your rendering knowledge from basic to pro by following along with multiple projects using a pro workflow\r\nBecome comfortable creating with the two industry standard software packages, 3ds Max and V-Ray\r\nLearn to use Photoshop for texture creation and post-processing your renderings\r\nLearn Vray materials, lighting and cameras.', '64 bit Windows operating system\r\nComputer and Internet\r\nAbility to download / install trial software\r\nBasic computer knowledge\r\nKnowledge of CAD, 3d software, photo editing, art / illustration -- helpful but not necessary.\r\nPrevious experience in a design field is helpful, but also not necessary.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `ins_rate` int(11) NOT NULL,
  `course_rate` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `learner_id`, `course_id`, `ins_rate`, `course_rate`, `teacher_id`, `comment`) VALUES
(20, 41, 23, 5, 5, 47, 'best'),
(21, 49, 15, 5, 5, 45, 'best'),
(22, 49, 17, 4, 3, 46, ''),
(23, 49, 16, 3, 3, 2, ''),
(24, 50, 10, 2, 4, 48, '\r\n\r\n'),
(25, 50, 14, 2, 3, 47, ''),
(26, 50, 12, 4, 5, 2, ''),
(27, 40, 12, 5, 5, 2, ''),
(28, 40, 6, 5, 4, 2, 'nice'),
(29, 50, 6, 5, 4, 2, ''),
(30, 41, 6, 5, 5, 2, ''),
(31, 51, 6, 5, 5, 2, ''),
(32, 41, 14, 4, 4, 47, '');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `degree` varchar(200) NOT NULL,
  `Experience` text NOT NULL DEFAULT '0',
  `university` text NOT NULL,
  `about` varchar(1000) NOT NULL,
  `img` text DEFAULT 'entities/ins/42_avatar.png',
  `resume` text DEFAULT NULL,
  `status` tinytext NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `user_id`, `degree`, `Experience`, `university`, `about`, `img`, `resume`, `status`) VALUES
(1, 45, 'b.tech', '1', 'ganpat university', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.', 'entities/ins/42_avatar.png', 'entities/resume/milan.pdf', '1'),
(2, 2, 'B.tech ', '5', 'uka tarsadiya university', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content', 'entities/ins/2_279A7326_2.JPG', 'entities/resume/RESUME.PDF', '1'),
(3, 46, 'b.tech', '2', 'nirma University', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.', 'entities/ins/42_avatar.png', 'entities/resume/ravi.pdf', '1'),
(4, 47, 'b.tech', '3', 'p.p.savani university', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.', 'entities/ins/42_avatar.png', 'entities/resume/keyur.pdf', '1'),
(5, 48, 'b.tech', '4', 'Delhi University', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.', 'entities/ins/42_avatar.png', 'entities/resume/sohil.pdf', '1');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `Description` text NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `title`, `sender`, `receiver`, `isAdmin`, `Description`, `status`, `date`) VALUES
(42, 'Wordpress for Beginners - Master Wordpress Quickly', 1, 2, 1, 'no good', 1, '2020-11-24 19:27:05'),
(43, 'Wordpress for Beginners - Master Wordpress Quickly', 1, 2, 1, 'no good', 1, '2020-11-24 19:27:10'),
(44, 'ok', 2, 1, 0, 'letter\r\n', 1, '2020-11-24 19:28:33'),
(54, 'DONE', 1, 2, 1, 'DONEDONE', 1, '2020-11-27 19:31:17'),
(72, 'Wordpress for Beginners - Master Wordpress Quickly', 1, 2, 1, 'course is not proper\r\n', 1, '2020-12-12 09:50:16'),
(73, 'erger', 1, 2, 1, 'regregerger', 1, '2020-12-12 09:53:13'),
(74, 'erger', 1, 2, 1, 'regregerger', 1, '2020-12-12 09:53:13'),
(75, 'from ins', 2, 1, 0, 'jksdjfjsdf', 1, '2020-12-12 09:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `plan` varchar(500) NOT NULL,
  `period` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan`, `period`, `price`, `status`) VALUES
(1, 'Bronze', '1 Month', 32, 1),
(2, 'Silver', '6 Months', 159, 1),
(3, 'Gold', '1 Year', 256, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Instructor'),
(3, 'Learner');

-- --------------------------------------------------------

--
-- Table structure for table `save_later`
--

CREATE TABLE `save_later` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `sub_start` date NOT NULL,
  `sub_end` date NOT NULL,
  `plan` varchar(500) NOT NULL,
  `duration` varchar(500) NOT NULL,
  `order_id` varchar(5000) NOT NULL,
  `txn_amount` varchar(500) NOT NULL,
  `pay_mode` varchar(500) NOT NULL,
  `txn_date` date NOT NULL,
  `txn_status` varchar(500) NOT NULL,
  `bank_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `learner_id`, `sub_start`, `sub_end`, `plan`, `duration`, `order_id`, `txn_amount`, `pay_mode`, `txn_date`, `txn_status`, `bank_name`) VALUES
(27, 41, '2020-12-16', '2021-12-16', 'Gold', '1 Year', 'ORD86267372', '89.00', 'NB', '2020-12-16', 'TXN_SUCCESS', 'SBI'),
(30, 40, '2020-12-18', '2021-01-18', 'Bronze', '1 Month', 'ORD38820528', '32.00', 'NB', '2020-12-18', 'TXN_SUCCESS', 'AXIS'),
(35, 51, '2020-12-19', '2021-01-19', 'Bronze', '1 Month', 'ORD3789324', '32.00', 'NB', '2020-12-19', 'TXN_SUCCESS', 'SBI'),
(36, 49, '2020-12-19', '2021-06-19', 'Silver', '6 Months', 'ORD76759722', '159.00', 'NB', '2020-12-19', 'TXN_SUCCESS', 'SBI');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT 3,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT current_timestamp(),
  `isSubscribed` tinyint(4) NOT NULL DEFAULT 0,
  `auth` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `role`, `email`, `password`, `signUpDate`, `isSubscribed`, `auth`) VALUES
(1, 'Chintan', 'Bambharoliya', 'chintan_admin', 1, 'info.ck.3764@gmail.com', '6cfe2603c92abdf6b2e324b0e9c8249daeb6f7e56fa2b515d4d16a6e307f9ba63e6a4cd23edafecb2567a33cc0590a5575a2e940fc0236269fe2a798394130c0', '2020-08-01 11:21:11', 1, 'd5eeec2afaaa6da64630a0c2xx571393ef266fef1457258099e4648b43c65fafeefe10f6f539b4d1da0d7ac1b14968b1063bd3b96ef0fb9a851dc9d5bf41e5ff50'),
(2, 'Parth', 'Butani', 'parth_ins', 2, 'parthb401@gmail.com', 'cb0a0a55a42c50e57816bc91a4104ee49b6f80a8ddbf7a1e40fc485a7428a8910b89c1aaf1850f24a4315a25bed04c0e9133a94677e6542db4a4aa2dbb657e75', '2020-08-11 20:36:03', 0, '6c24117690efd2f560473908a6f52c9f64dcd28fecbbcf05d9ac1cb08cde6d21c12b2b5f815639565de58a47e7c9821ecc702a7638ddb527e95ab1e6f036ebad'),
(40, 'Yash', 'Patel', 'Yash', 3, 'yash1451999@gmail.com', '36e793f4393667a9ac3c8801440bca69de5072a30c9f69cb5af1875497d0bc2c545a3a8c7efd7ea449b29e83b2d29bac7d038cc08f75bbe472f3de9d8dab803d', '2020-11-24 15:01:23', 1, 'a11b443e38aadb610fc4d5fc875ea556b2235769cb934c9e3b98d8673c48dc0908bd68039073cf7ae5e3a089e63b9c97371025427579de5c173ecbdc1e766178'),
(41, 'Parth', 'Butani', 'parth', 3, 'parth@parth.com', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', '2020-11-24 19:20:53', 1, 'dd0a0651b218a918b656779893d9ce2a821841dcf809a6c15911015015bf1b854787c0c3e4fd59824836b2f7cf3c74f2be311c0ef1edd52dc9dc947feb95772b'),
(45, 'Milan', 'Vora', 'milan', 2, 'milan@gmail.com', 'f755b88fad9eda1a853b534d20f7b795fb1c247697eeaf13d6064ca6fca0a6ff5de8519dd3cab8564a6a32698dcb80bf245d02a56d52c058ec61c962aab41966', '2020-12-12 09:45:23', 0, '7c1fa2fb9fed6f2cde8672430de88eddb3adb88a1c19eb97cd8d2e5ba9fbf6fe50f5cad7a3ebc44c5c19977c9b667b308e0be50544b24a0fbe4f5303fded084b'),
(46, 'Ravi', 'Kachhadiya', 'ravi_ins', 2, 'ravi@gmail.com', '4f79cd5c82114b9b5f06f3896232be648afbe0f9bd07f80711176ad57d494da5ee63fdae9e92f0af80649729128ea90d33af9a93bf6310fffe26ee34767c131e', '2020-08-11 20:36:03', 0, '86c24117690efd2f560473908a6f52c9f64dcd28fecbbcf05d9ac1cb08cde6d21c12b2b5f815639565de58a47e7c9821ecc702a7638ddb527e95ab1e6f036ebad'),
(47, 'Keyur', 'Kanjiya', 'keyur_ins', 2, 'keyur@gmail.com', '5a285709dd4db2a7e13af204ba1c8ec790df08e78abeb4adfd5bdc69d51458539e6287fbfce50682f1da19abd70e2d017b27638c64d10315d28d03a88f5e700d', '2020-08-11 20:36:03', 0, '9c24117690efd2f560473908a6f52c9f64dcd28fecbbcf05d9ac1cb08cde6d21c12b2b5f815639565de58a47e7c9821ecc702a7638ddb527e95ab1e6f036ebad'),
(48, 'Sohil', 'Patel', 'sohil_ins', 2, 'sohil@gmail.com', 'cb0a0a55a42c50e57816bc91a4104ee49b6f80a8ddbf7a1e40fc485a7428a8910b89c1aaf1850f24a4315a25bed04c0e9133a94677e6542db4a4aa2dbb657e75', '2020-08-11 20:36:03', 0, '2c24117690efd2f560473908a6f52c9f64dcd28fecbbcf05d9ac1cb08cde6d21c12b2b5f815639565de58a47e7c9821ecc702a7638ddb527e95ab1e6f036ebad'),
(49, 'Gautam', 'Patel', 'guatam', 3, 'guatam@guatam.com', '0e53dd522bf3746366215deb4b2384389f68fbda9088a422b564aacf661975824ade182a95494a35af734ddab777785f3e5935a2c9af647d3d0c7fc734ab6ad1', '2020-12-18 14:29:04', 1, '4f588ef933c519c1ff5664e23a6ffffcf973ef3105216707fac570c84fad297a9302b20a5ea4be1a8d333ad09e8ebdf5149f8c21ecbffa3708213f20180b013c'),
(50, 'Ravi', 'Patel', 'ravi', 3, 'ravi@ravi.com', '4f79cd5c82114b9b5f06f3896232be648afbe0f9bd07f80711176ad57d494da5ee63fdae9e92f0af80649729128ea90d33af9a93bf6310fffe26ee34767c131e', '2020-12-18 14:32:30', 0, '1764842851588983123dcc8a92369a458e2ea4ee13b7cdfb9257bb20ee2ffc038aab98cdedfb8c3e6cbb3bb462a9cce8593f345bd15635666fedd2df977e1b27'),
(51, 'Chintan', 'Patel', 'chintan', 3, 'chinatn@chintan.com', '6cfe2603c92abdf6b2e324b0e9c8249daeb6f7e56fa2b515d4d16a6e307f9ba63e6a4cd23edafecb2567a33cc0590a5575a2e940fc0236269fe2a798394130c0', '2020-12-18 15:12:19', 1, '3a579e6875799d9f513453269e6dc136ac12f3881635c5649549ecec030f61904356ffc294d8d8cf9edf4f584ec8f8a1fb4a8b06f5ed9997e7585f9ffc5a2e5c');

-- --------------------------------------------------------

--
-- Table structure for table `videoprogress`
--

CREATE TABLE `videoprogress` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `progress` int(11) NOT NULL DEFAULT 0,
  `current` decimal(65,0) NOT NULL,
  `finished` tinyint(4) NOT NULL DEFAULT 0,
  `dateModified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videoprogress`
--

INSERT INTO `videoprogress` (`id`, `learner_id`, `video_id`, `progress`, `current`, `finished`, `dateModified`) VALUES
(143, 41, 1993, 100, '13', 1, '2020-12-16 17:54:15'),
(144, 41, 2018, 100, '13', 1, '2020-12-16 19:57:06'),
(145, 41, 1975, 100, '13', 1, '2020-12-16 20:00:40'),
(146, 49, 1985, 100, '13', 1, '2020-12-18 14:29:37'),
(147, 49, 1986, 100, '13', 1, '2020-12-18 14:30:13'),
(148, 49, 1987, 100, '13', 1, '2020-12-18 14:30:21'),
(149, 49, 1988, 25, '3', 0, '2020-12-18 14:30:27'),
(150, 50, 1980, 100, '13', 1, '2020-12-18 14:32:55'),
(151, 50, 1982, 100, '13', 1, '2020-12-18 14:33:04'),
(152, 50, 1984, 100, '13', 1, '2020-12-18 14:33:11'),
(153, 40, 1982, 100, '13', 1, '2020-12-18 14:45:23'),
(154, 40, 1976, 100, '13', 1, '2020-12-18 14:50:46'),
(155, 50, 1976, 23, '3', 0, '2020-12-18 14:53:56'),
(156, 41, 1976, 100, '13', 1, '2020-12-18 15:08:03'),
(157, 51, 1976, 100, '13', 1, '2020-12-18 15:12:40'),
(158, 41, 1990, 0, '0', 0, '2020-12-18 15:34:07'),
(159, 41, 1984, 100, '13', 1, '2020-12-18 15:34:43'),
(160, 41, 1987, 0, '0', 0, '2020-12-18 15:37:39'),
(161, 41, 2019, 0, '0', 0, '2020-12-18 15:39:32'),
(162, 40, 1993, 100, '13', 1, '2020-12-18 15:51:46'),
(163, 40, 1984, 0, '0', 0, '2020-12-18 15:52:09'),
(164, 51, 1994, 100, '13', 1, '2020-12-19 13:44:16'),
(165, 51, 1990, 100, '13', 1, '2020-12-19 14:03:54'),
(166, 49, 2015, 0, '0', 0, '2020-12-19 19:05:05'),
(167, 49, 1997, 0, '0', 0, '2020-12-19 19:05:47'),
(168, 41, 1983, 100, '13', 1, '2020-12-23 13:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `previewvideo` text NOT NULL,
  `mainvideo` text NOT NULL,
  `entityId` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `uploadDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `previewvideo`, `mainvideo`, `entityId`, `views`, `uploadDate`) VALUES
(1971, 'entities/preview/download.mp4', 'entities/video/download.mp4', 1, 0, '2020-11-11 20:27:19'),
(1972, 'entities/preview/download.mp4', 'entities/video/download.mp4', 2, 0, '2020-11-11 20:27:19'),
(1973, 'entities/preview/download.mp4', 'entities/video/download.mp4', 3, 0, '2020-11-11 20:27:19'),
(1974, 'entities/preview/download.mp4', 'entities/video/download.mp4', 4, 0, '2020-11-11 20:27:19'),
(1975, 'entities/preview/download.mp4', 'entities/video/download.mp4', 5, 0, '2020-11-11 20:27:19'),
(1976, 'entities/preview/download.mp4', 'entities/video/download.mp4', 6, 0, '2020-11-11 20:27:19'),
(1977, 'entities/preview/download.mp4', 'entities/video/download.mp4', 7, 0, '2020-11-11 20:27:19'),
(1978, 'entities/preview/download.mp4', 'entities/video/download.mp4', 8, 0, '2020-11-11 20:27:19'),
(1979, 'entities/preview/download.mp4', 'entities/video/download.mp4', 9, 0, '2020-11-11 20:27:19'),
(1980, 'entities/preview/download.mp4', 'entities/video/download.mp4', 10, 0, '2020-11-11 20:27:19'),
(1981, 'entities/preview/download.mp4', 'entities/video/download.mp4', 11, 0, '2020-11-11 20:27:20'),
(1982, 'entities/preview/download.mp4', 'entities/video/download.mp4', 12, 0, '2020-11-11 20:27:20'),
(1983, 'entities/preview/download.mp4', 'entities/video/download.mp4', 13, 0, '2020-11-11 20:27:20'),
(1984, 'entities/preview/download.mp4', 'entities/video/download.mp4', 14, 0, '2020-11-11 20:27:20'),
(1985, 'entities/preview/download.mp4', 'entities/video/download.mp4', 15, 0, '2020-11-11 20:27:20'),
(1986, 'entities/preview/download.mp4', 'entities/video/download.mp4', 16, 0, '2020-11-11 20:27:20'),
(1987, 'entities/preview/download.mp4', 'entities/video/download.mp4', 17, 0, '2020-11-11 20:27:20'),
(1988, 'entities/preview/download.mp4', 'entities/video/download.mp4', 18, 0, '2020-11-11 20:27:20'),
(1989, 'entities/preview/download.mp4', 'entities/video/download.mp4', 19, 0, '2020-11-11 20:27:20'),
(1990, 'entities/preview/download.mp4', 'entities/video/download.mp4', 20, 0, '2020-11-11 20:27:20'),
(1991, 'entities/preview/download.mp4', 'entities/video/download.mp4', 21, 0, '2020-11-11 20:27:20'),
(1992, 'entities/preview/download.mp4', 'entities/video/download.mp4', 22, 0, '2020-11-11 20:27:20'),
(1993, 'entities/preview/download.mp4', 'entities/video/download.mp4', 23, 0, '2020-11-11 20:27:20'),
(1994, 'entities/preview/download.mp4', 'entities/video/download.mp4', 24, 0, '2020-11-11 20:27:20'),
(1995, 'entities/preview/download.mp4', 'entities/video/download.mp4', 25, 0, '2020-11-11 20:27:20'),
(1996, 'entities/preview/download.mp4', 'entities/video/download.mp4', 26, 0, '2020-11-11 20:27:20'),
(1997, 'entities/preview/download.mp4', 'entities/video/download.mp4', 27, 0, '2020-11-11 20:27:21'),
(1998, 'entities/preview/download.mp4', 'entities/video/download.mp4', 28, 0, '2020-11-11 20:27:21'),
(1999, 'entities/preview/download.mp4', 'entities/video/download.mp4', 29, 0, '2020-11-11 20:27:21'),
(2000, 'entities/preview/download.mp4', 'entities/video/download.mp4', 30, 0, '2020-11-11 20:27:21'),
(2001, 'entities/preview/download.mp4', 'entities/video/download.mp4', 31, 0, '2020-11-11 20:27:21'),
(2002, 'entities/preview/download.mp4', 'entities/video/download.mp4', 32, 0, '2020-11-11 20:27:21'),
(2003, 'entities/preview/download.mp4', 'entities/video/download.mp4', 33, 0, '2020-11-11 20:27:21'),
(2004, 'entities/preview/download.mp4', 'entities/video/download.mp4', 34, 0, '2020-11-11 20:27:21'),
(2005, 'entities/preview/download.mp4', 'entities/video/download.mp4', 35, 0, '2020-11-11 20:27:21'),
(2006, 'entities/preview/download.mp4', 'entities/video/download.mp4', 145, 0, '2020-11-11 20:27:21'),
(2007, 'entities/preview/download.mp4', 'entities/video/download.mp4', 146, 0, '2020-11-11 20:27:21'),
(2008, 'entities/preview/download.mp4', 'entities/video/download.mp4', 147, 0, '2020-11-11 20:27:21'),
(2009, 'entities/preview/download.mp4', 'entities/video/download.mp4', 148, 0, '2020-11-11 20:27:21'),
(2010, 'entities/preview/download.mp4', 'entities/video/download.mp4', 149, 0, '2020-11-11 20:27:21'),
(2011, 'entities/preview/download.mp4', 'entities/video/download.mp4', 150, 0, '2020-11-11 20:27:21'),
(2012, 'entities/preview/download.mp4', 'entities/video/download.mp4', 151, 0, '2020-11-11 20:27:21'),
(2013, 'entities/preview/download.mp4', 'entities/video/download.mp4', 152, 0, '2020-11-11 20:27:21'),
(2014, 'entities/preview/download.mp4', 'entities/video/download.mp4', 153, 0, '2020-11-11 20:27:21'),
(2015, 'entities/preview/download.mp4', 'entities/video/download.mp4', 156, 0, '2020-11-11 20:27:21'),
(2016, 'entities/preview/download.mp4', 'entities/video/download.mp4', 157, 0, '2020-11-11 20:27:22'),
(2017, 'entities/preview/download.mp4', 'entities/video/download.mp4', 158, 0, '2020-11-11 20:27:22'),
(2018, 'entities/preview/download.mp4', 'entities/video/download.mp4', 159, 0, '2020-11-11 20:27:22'),
(2019, 'entities/preview/download.mp4', 'entities/video/download.mp4', 160, 0, '2020-11-11 20:27:22'),
(2020, 'entities/preview/download.mp4', 'entities/video/download.mp4', 161, 0, '2020-11-11 20:27:22'),
(2021, 'entities/preview/download.mp4', 'entities/video/download.mp4', 162, 0, '2020-11-11 20:27:22'),
(2022, 'entities/preview/download.mp4', 'entities/video/download.mp4', 163, 0, '2020-11-11 20:27:22'),
(2023, 'entities/preview/download.mp4', 'entities/video/download.mp4', 164, 0, '2020-11-11 20:27:22'),
(2024, 'entities/preview/download.mp4', 'entities/video/download.mp4', 165, 0, '2020-11-11 20:27:22'),
(2025, 'entities/preview/download.mp4', 'entities/video/download.mp4', 166, 0, '2020-11-11 20:27:22'),
(2026, 'entities/preview/download.mp4', 'entities/video/download.mp4', 167, 0, '2020-11-11 20:27:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `tacherid` (`teacherid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `learner_id` (`learner_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_ibfk_1` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `message_ibfk_1` (`receiver`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save_later`
--
ALTER TABLE `save_later`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `videoprogress`
--
ALTER TABLE `videoprogress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`),
  ADD KEY `learner_id` (`learner_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entityId` (`entityId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `save_later`
--
ALTER TABLE `save_later`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `videoprogress`
--
ALTER TABLE `videoprogress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2027;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entities`
--
ALTER TABLE `entities`
  ADD CONSTRAINT `entities_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `entities_ibfk_2` FOREIGN KEY (`teacherid`) REFERENCES `instructor` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `entities` (`id`),
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`learner_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `save_later`
--
ALTER TABLE `save_later`
  ADD CONSTRAINT `save_later_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `entities` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);

--
-- Constraints for table `videoprogress`
--
ALTER TABLE `videoprogress`
  ADD CONSTRAINT `videoprogress_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`),
  ADD CONSTRAINT `videoprogress_ibfk_2` FOREIGN KEY (`learner_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`entityId`) REFERENCES `entities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
