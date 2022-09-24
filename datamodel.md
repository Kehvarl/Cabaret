#### Room
* String : Name
* String : Description
* Array(Login) : Logins
* Array(Post)  : Posts


#### Post
* String : Name
* String : Color
* String : Font
* String : MessageText


#### Login
* User   : User
* String : Name
* Date   : LastUpdate
* String : InProgress


#### User
* Int    : ID
* String : Username
* String : Email
* String : PasswordHash


#### LoginHistory
* Int    : ID
* User   : User
* Room   : Room
* String : Name
* Date   : Date

 