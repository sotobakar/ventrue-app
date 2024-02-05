# VENTRUE (Veteran Event Us X Everyone)

## Table of Contents

- [Description](#description)
- [Challenges Addressed](#challenges-addressed)
- [Solution](#solution)
- [Installation](#installation)
- [Usage](#usage)

## Description

This project was built to become my undergraduate thesis project for my Information Systems degree. Other than the neccessary written thesis, I also needed to provide a practical solution during my presentation. This was my solution which is an event management system with a website interface. 

Actually it came up from a competition in my uni, about the lack of a system to help student organizations and students.

Based on a survey conducted with 70 respondents (90.9% of the participants), the need for an efficient event management system was identified. The top three reasons for this demand are as follows:

1. **Dissemination of Information:** The system will ensure that event information is effectively communicated and distributed evenly across the community.

2. **Ease of Event Search:** Users can easily search for upcoming events, facilitating their participation in various activities.

3. **Efficient Information Management:** The system will simplify the process of managing and organizing event-related information.

## Challenges Addressed

The survey highlighted three main challenges faced by respondents in accessing and registering for events:

1. **Uncoordinated Event Information:** Lack of coordination in disseminating event details leads to important information getting lost or overlooked.

2. **Lack of Event Reminders:** Participants often forget about events due to the absence of reminders from organizers.

3. **Complex Registration Process:** The existing system's complexity, requiring participants to copy registration links and join social media groups, poses a usability challenge.

## Solution

I use the following technologies to accommodate the business requirements in what was written in my thesis.

1. **Laravel 9 with PHP 8.1** as the application framework
2. **Blade Templates + TailwindCSS** for frontend
3. **MySQL** for data storage and retrieval
4. **SMTP** for Email Sending
5. **Google OAuth2** to use Google Sign-In
5. **Docker** for production-like environment during development
6. **Cron** for event reminders

## Features

### 1. **Participant**

  a. **Registration:**
    - Student can register on the platform.

  b. **Login:**
    - Student can log in to the website.

  c. **Profile Management:**
    - Student can update their profile information.

  d. **View Upcoming Events:**
    - Student can see a list of upcoming events.

  e. **Search Events by Name:**
    - Student can search for events based on their names.

  f. **Search Events by Category:**
    - Student can search for events based on categories.

  g. **Event Registration:**
    - Student can register for a specific event.

  h. **View Event Details:**
    - Student can view detailed information about an event, including description, time, participant count, location, event link, and requirements.

  i. **View Registered Events (History):**
    - Student can see a list of events they have registered for.

  j. **Attendance Submission:**
    - Student can submit attendance for an event.

  k. **Provide Event Feedback:**
    - Student can provide feedback on an event.

  l. **Generate Event Certificate:**
    - Student can generate a certificate as proof of event participation after the event concludes.

  m. **Receive Event Reminders:**
    - Student can receive reminders before the start of an event.


### 2. **Student Organization (Ormawa)**

  a. **View Dashboard Statistics:**
    - Organization can view statistics on the dashboard.

  b. **Profile Management:**
    - Organization can update their profile information.

  c. **Event Management:**
    - Organization can create, update, and delete events.

  d. **Open/Close Event Registration and Attendance:**
    - Organization can manage the opening and closing of event registration and attendance.

  e. **Display QR Code for Event Attendance:**
    - Organization can display a QR code for event attendance.

  f. **Download Participant Data:**
    - Organization can download participant data for events.

  g. **Receive Event Feedback:**
    - Organization can receive feedback after an event concludes.

  h. **Provide Event Materials to Participants:**
    - Organization can provide event materials to participants.

### 3. **Admin**

  a. **View Overall Statistics:**
    - Admin can view overall statistics for Participants, Organizations, and Events.

  b. **Manage Organization Accounts:**
    - Admin can create, update, and delete Organization accounts.

  c. **Manage Student Accounts:**
    - Admin can create, update, and delete Student accounts.

  d. **Manage Events:**
    - Admin can create, update, and delete events.

  e. **Modify Landing Page Content:**
    - Admin can modify the content of the landing page.

### 4. **General Affairs Bureau (Biro Umum)**

  a. **View Overall Statistics:**
    - Biro Umum can view overall statistics for the number of rooms and the number of events with schedule conflicts in UPN Veteran Jakarta.

  b. **Manage Locations:**
    - Biro Umum can view, create, update, and delete room locations.

  c. **View Room Schedule:**
    - Biro Umum can view the schedule of room usage, identifying any conflicts.

### 5. **Academic Bureau (Biro AKPK)**

  a. **View Overall Statistics:**
    - Biro AKPK can view overall statistics for the number of events awaiting validation.

  b. **View Event Details:**
    - Biro AKPK can view detailed information about events that require validation.

  c. **Approve Events:**
    - Biro AKPK can approve events.

## Installation

**Step 1:** Clone the Repository

```bash
git clone https://github.com/sotobakar/ventrue-app.git
```

**Step 2:** Copy Environment Configuration

Copy the provided example environment configuration to create your own configuration file.

```bash
cp .env.example .env
```

**Step 3:** Modify Docker Compose Configuration

Open the docker-compose-dev.yml file and update the command in the php service:

```yaml
services:
  php:
    command: tail -F any
```

**Step 4:** Run Docker Compose

```bash
docker compose -f docker-compose-dev.yml up
```

**Step 5:** Setup Dependencies

Open another terminal in the project directory and run the following commands step by step:

```bash
# Run interactive container shell
docker-compose exec -it php sh

# Install Composer dependencies
composer install

# Install Node.js dependencies
npm install

# Generate application key
php artisan key:generate

# Populate the database
sh populate.sh
```

**Step 6:** Return to 1st Terminal & Stop Docker Compose

In the terminal where Docker Compose is running, stop the process by pressing **Ctrl + C**.

**Step 7:** Update Docker Compose Configuration (Undo Changes)

Undo the changes made to **docker-compose-dev.yml**:

```yaml
services:
  php:
    command: sh -c "npm run build && php artisan serve --host 0.0.0.0"
```

**Step 8:** Run Docker Compose Again

```bash
docker-compose -f docker-compose-dev.yml up
```

**Step 9:** Access the Website

Visit **http://localhost:8080** in your web browser to access the website.

## Usage

Coming soon