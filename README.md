![](https://media.giphy.com/media/o0vwzuFwCGAFO/giphy.gif)

# Hacker-news

Welcome to my version of Hacker News! <br>
Here you can create a user, login, <br>
create posts and comment on posts. <br>

This site is built with PHP, CSS, HTML, SQL and Javascript.

# Installation

Clone repo from https://github.com/rikardseg/Hacker-news <br>
with either command line or github desktop.

Load the application via localhost in your command line.

# Code Review

[Jakob Gustafsson](https://github.com/gusjak)

1. Snygg lösning på sorteringen av posts med dropdown menyn i navigationsbaren, så man slipper byta sida. Hade dock gärna haft med navigationsbaren i toppen på varje sida, inte bara i index.php, men då sorteringen av posts ligger i den är det ändå logiskt.
2. Det blir lite omständigt att användaren måste byta lösenord varje gång den ska ändra något i sin profil. En lösning hade varit att dela upp det i flera olika formulär i 'edituser.php'. Ett för användarinformation (som du gör i app/users/handleuser.php). och ett andra formulär för att ändra lösenordet (t.ex app/users/changepassword.php).
3. I functions.php hade du kunnat ha en redirect-funktion istället för att återupprepa "header("Location: /../../path"); exit;" i filerna där du hanterar kommentarer/posts/användare ändringar. Den var inkluderad i projektstrukturen Vincent gav oss.
4. När man ska ändra sitt inlägg kan man byte ut id-numret i URL:en 'post.php?id=19' till t.ex 'post.php?id=18' och ändra/ta bort andra användares inlägg. Här kanske man kan lägga till en funktion som kollar om $\_SESSION['user'] stämmer överrens med "user" i posts-tabellen.
5. Kanske mer "filters" när man registrerar ett konto, om användaren t.ex lägger in oönskade tecken i användarnamn så kanske ett felmeddelande visas istället för att kontot skapas med en saniterad sträng av det man fyllde i som användarnamn. Kanske minimum antal tecken på lösenord typ "if(strlen($password) < 6) { $\_SESSION['error_message'] = "Password must be at least 6 characters."; }".
6. Bra att det inte är tvång att skriva i 'Biography' eller välja en profilbild under signup.
7. Ett tips är att dela in din kod i flera filer, det kan bli lite rörigt och många if-satser till slut. Så t.ex en fil för att 'INSERT INTO users' och en annan för 'UPDATE users'.
8. Det hade varit nice att kunna granska sin egen profil, samt andra användares profiler.
9. Småsak men när man upvotar en post så refreshas antal upvotes, men om ett inlägg då får mer upvotes än inlägget över så byter de inte plats. En enkel, men inte så fin lösning kan vara att refresha sidan när man upvotar/downvotar. Om man redan upvotat en post kanske arrowUp-knappen i index.php[line: 86] ändras till en arrowDown?
10. Bra jobbat! Clean och lättnavigerad hemsida.

# Testers

Simon Lindstedt, Jonathan Larsson

# HackerNews +

Erik White

Extra features added by: [Erik White](https://github.com/nausea87)

Link to pull request: ''

- As a user I'm able to delete my account along with all posts, upvotes, comments, and (bonus) replies.

- As a user I'm able to post replies.
