#1 Requirements for the first kind of sprint

The clue of project is to realize with symfony framework simple blog/mysite CMS and realise simple functional.
Frontend will be implemented with Twig bundle.
For the first there wouldn't be any design in page, just simple HTML. 
All styles and javascript will be added later. This part of app building is not about frontend.
Project is stored in bitbucket repository and developing from two computers via command line GIT client.

As a task manager will be used trello.com.

Web Server: Apache,
PHP Version: 7.3,
Symfony Version: ^,
Dependency manager: Composer,
Database: MySQL.

Functional requirements:

1. Main page with header, body and footer parts.
- Header must contain logotype, menu and login/register links.
- Body must contain article space and sidebar.
- Footer must contain logo, social links and phone.

2. Site must contain two types of pages: static and non-static.
- For static pages: "Contacts", "About me(us)", register form, login form and "_blogpost".
- For non-static: main blog page with default sorting, and page with sortings.

3. Blog functionality.
- Blog must contain pagination, sort by date button. Preview block of blogpost must have: Title, picture, short content, date, author name, like counter and comment counter.
- Blogpost must contain Title, picture, content, date, author name, like counter and comment form.

3. Administration functionality.
- Blogpost commenting and liking must be available only for registered and logged users.
- Must be admin page with posts list (with pagination). Every post must have delete and edit button. Must be "add post" button".
- Must be an "add post" page (same as "edit"), where admin can edit page. In post that already exist "Publish" page must be replaced with "Confirm edit".