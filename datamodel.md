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
 