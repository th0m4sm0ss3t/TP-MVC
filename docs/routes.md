# Routes

## Sprint 1

> Les infos entourées par un # sont des textes dynamiques, selon l'endroit où se trouve.

| URL | Méthode HTTP | Controller | Méthode | Titre | Contenu | Commentaire |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | Home | access to login or register | - |
| `/legal-mentions/`| `GET`| `MainController` | `legalMentions` | Mentions légales | Legal Mentions | - |
| `/profil/[id]` | `GET` | `UserController` | `profil` | #profil# | user's profil | [id] represents the id of the user |
| `/login` | `GET` | `UserController` | `user` | #profil# | user's profil | [id] represents the id of the user |
| `/user/add` | `GET`| `UserController` | `add` | Ajouter un utilisateur | Form to add a user | - |
| `/user/update/[i:userId]` | `GET`| `UserController` | `update` | Éditer un utilisateur | Form to update a user | [i:userId] is the user to update |
| `/user/delete/[i:userId]` | `GET`| `UserController` | `delete` | Supprimer un utilisateur | User delete | [i:userId] is the user to delete |
| `/stories` | `GET` | `StoryController` | `stories` | #List of stories# |  List of stories | |
| `/stories/[id]` | `GET` | `StoryController` | `story` | #Name of the story# |  Read the story | [id] represents the id of the story |
| `/stories/add` | `GET`| `StoryController` | `add` | Ajouter une histoire | Form to add a story | - |
| `/stories/update/[i:storyId]` | `GET`| `StoryController` | `update` | Éditer une histoire | Form to update a story | [i:storyId] is the story to update |
| `/stories/delete/[i:storyId]` | `GET`| `StoryController` | `delete` | Supprimer une histoire | Story delete | [i:storyId] is the story to delete |