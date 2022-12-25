
## Laravel Deep Query (Fetch Multiple Related Data in one query)

## _Fetch All Details In One Query_


```php 

Posts:
    -> BelongsTo     (User)
    -> BelongsToMany (Tag)
    -> morphMany     (Comment)
    -> morphMany     (Like)

User:
    -> BelongsToMany (Likes)
    -> hasMany       (Posts)

Tags:
    -> BelongsToMany (Posts)

Likes:
    -> BelongsTo (User)
    -> BelongsTo (Post)
    -> BelongsTo (Comment)

Comments:
    -> BelongsTo (User)
    -> hasMany   (Replies)
    -> morphMany (Likes)



```
