DROP DATABASE IF EXISTS application_database;

CREATE DATABASE application_database;

-- Use the newly created database
USE application_database;

-- Create the joboffers table
CREATE TABLE joboffers (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(100) NOT NULL,
  description TEXT,
  requirements TEXT,
  salary DECIMAL(10, 2),
  location VARCHAR(100),
  posting_date DATE NOT NULL
);

-- Create the applicants table
CREATE TABLE applicants (
  id INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone VARCHAR(20),
  resume BLOB NOT NULL,
  application_date DATE NOT NULL,
  joboffer_id INT,
  FOREIGN KEY (joboffer_id) REFERENCES joboffers(id)
    ON UPDATE CASCADE
    ON DELETE SET NULL
);

-- Insert mock data into the joboffers table
INSERT INTO joboffers (title, description, requirements, salary, location, posting_date)
VALUES
  ('Software Developer', 'We are seeking a skilled Software Developer to join our team. You will be responsible for developing and maintaining software applications.', "Requirements: Bachelor's degree in Computer Science or related field, proficiency in programming languages such as Java or Python, experience with database management systems.", 60000, 'New York', '2023-07-01'),
  ('Marketing Manager', 'We are looking for an experienced Marketing Manager to lead our marketing campaigns. You will be responsible for developing and executing marketing strategies to promote our products and services.', "Requirements: Bachelor's degree in Marketing or related field, proven experience in developing and executing marketing strategies, strong analytical and project management skills.", 70000, 'San Francisco', '2023-07-02'),
  ('Sales Representative', 'We have an exciting opportunity for a Sales Representative to join our sales team. Your primary responsibility will be to generate leads, build relationships with clients, and close sales.', "Requirements: Excellent communication and negotiation skills, proven sales experience, ability to build and maintain customer relationships.", 50000, 'Chicago', '2023-07-03'),
  ('UX Designer', 'We are seeking a creative UX Designer to enhance user experiences. Your role will involve designing user interfaces, conducting user research, and creating wireframes and prototypes.', "Requirements: Bachelor's degree in Design or related field, strong portfolio showcasing UX design skills, proficiency in design tools such as Sketch or Adobe XD.", 55000, 'Seattle', '2023-07-04'),
  ('Data Analyst', 'We are hiring a Data Analyst to analyze and interpret complex data sets. You will be responsible for collecting, cleansing, and analyzing data to provide valuable insights and support decision-making.', "Requirements: Bachelor's degree in Statistics, Mathematics, or related field, strong analytical and problem-solving skills, proficiency in data analysis tools such as SQL and Python.", 65000, 'Boston', '2023-07-05'),
  ('Operations Manager', 'We are looking for a highly organized Operations Manager to oversee daily operations. You will be responsible for optimizing processes, managing resources, and ensuring efficiency and productivity.', "Requirements: Bachelor's degree in Business Administration or related field, proven experience in operations management, excellent leadership and problem-solving skills.", 75000, 'Los Angeles', '2023-07-06'),
  ('Web Developer', 'We are seeking a talented Web Developer to join our dynamic team. You will be responsible for designing, coding, and modifying websites and web applications.', "Requirements: Bachelor's degree in Computer Science or related field, proficiency in HTML, CSS, JavaScript, and experience with front-end frameworks such as React or Angular.", 55000, 'London', '2023-07-07'),
  ('Graphic Designer', 'We are looking for a creative Graphic Designer to join our design team. Your role will involve creating visual concepts and assets for various marketing materials.', "Requirements: Bachelor's degree in Graphic Design or related field, proficiency in design software such as Adobe Photoshop and Illustrator, and a strong portfolio showcasing your design skills.", 50000, 'Paris', '2023-07-08'),
  ('Data Scientist', 'We have an exciting opportunity for a Data Scientist to analyze and interpret complex data sets. You will be responsible for applying advanced statistical analysis and machine learning techniques.', "Requirements: Master's degree or PhD in Data Science, Statistics, or related field, strong programming skills in languages such as Python or R, and experience with data visualization tools.", 75000, 'Berlin', '2023-07-09'),
  ('Operations Coordinator', 'We are seeking an Operations Coordinator to support our daily operations. Your role will involve coordinating schedules, managing documentation, and ensuring smooth workflow.', "Requirements: Bachelor's degree in Business Administration or related field, excellent organizational and multitasking abilities, and strong attention to detail.", 45000, 'Toronto', '2023-07-10'),
  ('Quality Assurance Engineer', 'We are looking for a meticulous Quality Assurance Engineer to ensure the quality and functionality of our software products. You will be responsible for designing and executing test plans.', "Requirements: Bachelor's degree in Computer Science or related field, strong knowledge of software testing methodologies, and experience with automated testing tools.", 60000, 'San Francisco', '2023-07-11'),
  ('Financial Analyst', 'We have an opening for a Financial Analyst to analyze financial data and provide valuable insights. You will be responsible for forecasting, budgeting, and financial reporting.', "Requirements: Bachelor's degree in Finance, Accounting, or related field, strong analytical and problem-solving skills, and proficiency in financial analysis software.", 65000, 'New York', '2023-07-12');

-- Insert mock data into the applicants table
INSERT INTO applicants (first_name, last_name, email, phone, resume, application_date, joboffer_id)
VALUES
  ('John', 'Doe', 'john.doe@example.com', '1234567890', 'Resume of John Doe', '2023-07-01', 1),
  ('Jane', 'Smith', 'jane.smith@example.com', '2345678901', 'Resume of Jane Smith', '2023-07-02', 2),
  ('Michael', 'Johnson', 'michael.johnson@example.com', '3456789012', 'Resume of Michael Johnson', '2023-07-03', 1),
  ('Emily', 'Williams', 'emily.williams@example.com', '4567890123', 'Resume of Emily Williams', '2023-07-04', 3),
  ('David', 'Brown', 'david.brown@example.com', '5678901234', 'Resume of David Brown', '2023-07-03', 2),
  ('Sarah', 'Taylor', 'sarah.taylor@example.com', '6789012345', 'Resume of Sarah Taylor', '2023-07-05', 1),
  ('Robert', 'Johnson', 'robert.johnson@example.com', '7890123456', 'Resume of Robert Johnson', '2023-07-07', 3),
  ('Jessica', 'Davis', 'jessica.davis@example.com', '8901234567', 'Resume of Jessica Davis', '2023-07-03', 2),
  ('Michael', 'Miller', 'michael.miller@example.com', '9012345678', 'Resume of Michael Miller', '2023-07-02', 1),
  ('Sophia', 'Anderson', 'sophia.anderson@example.com', '0123456789', 'Resume of Sophia Anderson', '2023-07-11', 3),
  ('Matthew', 'Wilson', 'matthew.wilson@example.com', '2345678901', 'Resume of Matthew Wilson', '2023-07-15', 2),
  ('Olivia', 'Clark', 'olivia.clark@example.com', '3456789012', 'Resume of Olivia Clark', '2023-07-09', 1),
  ('Daniel', 'Anderson', 'daniel.anderson@example.com', '4567890123', 'Resume of Daniel Anderson', '2023-07-03', 3),
  ('Sophie', 'Thomas', 'sophie.thomas@example.com', '5678901234', 'Resume of Sophie Thomas', '2023-07-14', 2),
  ('Andrew', 'Jackson', 'andrew.jackson@example.com', '6789012345', 'Resume of Andrew Jackson', '2023-07-05', 1),
  ('Ava', 'Wilson', 'ava.wilson@example.com', '7890123456', 'Resume of Ava Wilson', '2023-07-02', 3),
  ('Henry', 'Brown', 'henry.brown@example.com', '8901234567', 'Resume of Henry Brown', '2023-07-01', 2),
  ('Oliver', 'Jones', 'oliver.jones@example.com', '9012345678', 'Resume of Oliver Jones', '2023-07-18', 1),
  ('Sophia', 'Martin', 'sophia.martin@example.com', '0123456789', 'Resume of Sophia Martin', '2023-07-19', 3),
  ('William', 'Thomas', 'william.thomas@example.com', '2345678901', 'Resume of William Thomas', '2023-07-22', 2),
  ('Charlotte', 'Harris', 'charlotte.harris@example.com', '3456789012', 'Resume of Charlotte Harris', '2023-07-11', 1),
  ('James', 'Lee', 'james.lee@example.com', '4567890123', 'Resume of James Lee', '2023-07-28', 3),
  ('Amelia', 'Robinson', 'amelia.robinson@example.com', '5678901234', 'Resume of Amelia Robinson', '2023-07-13', 2),
  ('Ethan', 'White', 'ethan.white@example.com', '6789012345', 'Resume of Ethan White', '2023-07-04', 1),
  ('Mia', 'Anderson', 'mia.anderson@example.com', '7890123456', 'Resume of Mia Anderson', '2023-07-15', 3);






