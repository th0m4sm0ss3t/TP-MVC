# Dictionnaire de données

## Users (`users`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT |user's id|
|email|VARCHAR(320)| NOT NULL, UNIQUE| user's email|
|username|VARCHAR(50)|NULL, UNIQUE| user's name|
|password|VARCHAR(255)| NOT NULL| user's password|
|created_at| DATETIME | NULL, CURRENT_TIMESTAMP| date of creation of the user |

## Stories (`stories`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|stories_id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT| story's id|
|stories_title|VARCHAR(400)|NOT NULL, UNIQUE| story's title |
|stories_content|MEDIUM TEXT | NOT NULL| story's content |
|stories_created_at| DATETIME |NULL, CURRENT_TIMESTAMP| date of creation of the story |
|users_id| INT|FOREIGN KEY| user's id that created the story|