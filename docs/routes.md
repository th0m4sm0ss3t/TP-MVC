# Routes

## Sprint 1

> Les infos entourées par un # sont des textes dynamiques, selon l'endroit où se trouve.

| URL | Méthode HTTP | Controller | Méthode | Titre | Contenu | Commentaire |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | Accueil | |
| `/[?]` | `GET` | `MainController` | `error404` | Erreur 404 | 404 page | Access to login or register | [?] represents a non-matching route requested by a visitor |
| `/stories` | `GET` | `StoryController` | `storiesList` | Liste des histoires |  List all the stories and their authors | |
| `/stories/[i:id]` | `GET` | `StoryController` | `story` | #Story's title# |  The story's title, content and author | [id] represents the id of the story |
| `/addStory` | `GET` | `StoryController` | `addStoryView` | Ajouter une histoire |  Form that allows you to add a story (title + content) | |
| `/addStory` | `POST` | `StoryController` | `addStoryCreation` | Ajouter une histoire | - | |
| `/storyAddConfirmation` | `GET` | `StoryController` | `storyAddConfirmation` | Histoire ajoutée |  Confirmation that the story has been added  | |
| `/deleteStory` | `GET` | `StoryController` | `deleteStory` | Supprimer mon histoire | Access to the delete form | |
| `/deleteStory` | `POST` | `StoryController` | `checkDeleteStory` | Supprimer mon histoire | - | |
| `/updateStory` | `GET` | `StoryController` | `updateStory` | Modifier mon histoire | Access to the update form | |
| `/updateStory` | `POST` | `StoryController` | `checkUpdateStory` | Modifier mon histoire | - | |
| `/searchStory` | `GET` | `StoryController` | `searchStory` | Rechercher une histoire | Access to the search form | |
| `/searchStory` | `POST` | `StoryController` | `checkSearchStory` | Rechercher une histoire | - | |
| `/authors/[i:id]` | `GET` | `AuthorController` | `author` | #Author's name# |  List the author's stories | [id] represents the id of the author |
| `/searchAuthor` | `GET` | `AuthorController` | `searchAuthor` | Rechercher un·e auteur·ice | Access to the search form | |
| `/searchAuthor` | `POST` | `AuthorController` | `checkSearchAuthor` | Rechercher un·e auteur·ice | - | |
| `/login` | `GET` | `UserController` | `login` | Se connecter | Access to login form | |
| `/login` | `POST` | `UserController` | `checkLogin` | Se connecter | - | |
| `/logout` | `POST` | `UserController` | `checkLogout` | - | - | |
| `/signup` | `GET` | `UserController` | `signup` | S'inscrire | Access to signup form to register | |
| `/signup` | `POST` | `UserController` | `checkSignup` | S'inscrire | Access to signup form | |
| `/resetPassword` | `GET` | `UserController` | `resetPassword` | Modifier son mot de passe | Access to signup form to register | |
| `/resetPassword` | `POST` | `UserController` | `checkResetPassword` | Modifier son mot de passe | - | |
| `/profil` | `GET` | `UserController` | `userProfil` | Mon profil | Access to the user's own profil | |
| `/deleteProfil` | `GET` | `UserController` | `deleteProfil` | Supprimer mon profil | Access to the delete form | |
| `/deleteProfil` | `POST` | `UserController` | `checkDeleteProfil` | Supprimer mon profil | - | |
| `/profilDeletedConfirmation` | `GET` | `UserController` | `profilDeletedConfirmation` | Profil supprimé | Confirmation that the user's profil has been deleted | |