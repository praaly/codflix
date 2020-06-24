# CodFlix project

## Setup

### Run
1. You have to use a local server such as Wamp or Mamp
1. Import the database `codflix.sql`
1. Pull the repo in the `www/` directory of your local server
1. Follow the address of your repo. For example, if your repo is in ``www/codflix/``, the URL should be http://localhost/codflix or http://127.0.0.1/codflix

Nothing else is required. You can now start your development

## Updates
### Update 25/06/2020 01:06
- Bugs correction
- Creation of the history page, currently it displays the data.


### Update 24/06/2020 22:33
- Bugs correction
- Episode CSS reform
- Update database, codflix.sql added.

### Update 24/06/2020 21:37

-Correction of the contact form, email is sent to the requested email address.
-The media are separated, we have a slider for movies and a slider for series.
-In the content the series have an additional option with season and episode.

- Creation of two new tables to create series, a listSeason and a listEpisode table.
They are both linked on Media.

### Update 24/06/2020 10:49
- Fixed several bugs (error message, security message).
- The search bar is functional, we can search for any movie with abrevations, (example: top for top gun).
- The media list shows the summary of each film/series with 60 characters maximum. You have to click on the film to get the full page of the film/series.
- The verification mail now sends a mail with HTML in it (table).

![](https://img.praaly.fr/uploads/explorer_DYc1cm6I58.png)


### Update 23/06/2020 20:49
- The movies are now displayed on the page.
- Once registered, the user must activate his account by email (an email is sent).
- The contact page is created, the form too, (php to do).


### Update 23/06/2020 14:00
- Registration is 95% complete.
- Email unique.
- Passwords must contain (8 letters, 1 capital letter, 1 number and a special character).


### Update 23/06/2020 13:30
- Registration is 80% complete, the user can register and log in.
- (Using a more secure method for the password (password_hash/password_verify)).
