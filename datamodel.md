* Room
  * String : Name
  * String : Description
  * Array(Login) : Logins
  * Array(Post)  : Posts
  * Func   : Join
  * Func   : Leave
  * Func   : Post

* Post
  * String : Name
  * String : Color
  * String : Font
  * String : MessageText
  * Func   : Create

* Login
  * User   : User
  * String : Name
  * Date   : LastUpdate
  * String : InProgress
  * Func   : Create
  * Func   : Exists

* User
  * Int    : ID
  * String : Username
  * String : Email
  * String : PasswordHash
  * Func   : Create
  * Func   : Login
  * Func   : Update

* LoginHistory
  * Int    : ID
  * User   : User
  * Room   : Room
  * String : Name
  * Date   : Date
  * Func   : Add
 

What object does the SQL interation?
Does each object do its own?
* SQL Qeuries needed
  * Available Rooms
    * Rooms -> List
  * Logins in Room
    * Rooms -> List_Logins
    * Logins -> List(Room)
  * Posts in Room
    * Room -> List_Posts
    * Post -> List(Room)
  * Logins for User
    * User -> List_Logins
    * Logins -> List_For(User)
  * Create Room
    * Room -> Create
  * Create User
    * User -> Create
  * Create Login
    * Login -> Create
    * Room -> Create_Login
    * User -> Create_Login(Room)
  * Create Post
    * Post -> Create
    * Room -> Create_Post(Login)
    * Login -> Create_Post