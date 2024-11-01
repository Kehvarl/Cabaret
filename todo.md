# Cabaret
* What is Cabaret
* What is a suitable MVP
* What additional features are needed to take us from MVP to Finished?

Cabaret is a simple web chatroom platform for roleplay communities

Our intended featureset includes:
* Registered Users
  * Do we require an email?
  * What history do we track
    * Most recent login
    * Most recent IP
    * Login history with IP?
  * User-Room Nickname
    * Do we track history of this as well?
* Multiple Rooms
  * Public and Private Rooms
  * Masquerade Roleplay Rooms - Hide Username and show only room-specific nickname


## Data Model Revisited
* User_Types
  * ID
  * Label
  * User_Level

* User
  * ID
  * Type
  * Nickname
  * Password_Hash

* User_Login
  * ID
  * Login_Timestamp

* Room
  * ID
  * Title
  * Short_Description
  * Long_Description

* Room_Users
  * Room_ID
  * User_ID
  * Display_Name
  * Last_Activity_Timestamp

* Room_Messages
  * Room_ID
  * User_ID
  * Display_Name
  * Display_Color
  * Font
  * Timestamp

* Create_User Name Password
* Login Name Password
* Logout User
* Create_Room Name
* Join_Room RoomID UserID NickName
* Post RoomID UserID NickName Message Color Font

* Login Process
  * Get username
  * Get password (hash client-side?  Cant, need salt)
  * Send to API
  * Compare user+hash to DB
  * return {ok, auth-token} or {error, error}
    * User not found
    * Password mismatch

Once logged in, allow user to join some rooms
One room or multiple in tabs?
Nickname per room
Regiser nicknames to user?

## Backend
1) Users
   1) Data Model
      * ID
      * Access_Level
        * Guest
        * User
        * Admin
      * Username
      * Email
      * Password_Hash
      * Login_Disabled
      * Login_ReActivate_Time
      * Registration
      * Last_Login
   2) Class
      1) Create
      2) Login
      3) Logout
      4) Update
2) Alias
   1) Data Model
      * ID
      * User_ID
      * Room_ID
      * Display_Name
      * Display_Color
      * Last_Activity
   2) Class
      1) Create
      2) Release
3) Room
   1) Data Model
      * ID
      * Short_Name
      * Long_Name
      * Description
      * Owner_ID
      * Allow_Alias
      * Masquerade
      * Masque_Reveal_Time
      * Create_Date
4) Post
   1) Data Model
      * ID
      * Room_ID
      * Login_ID
      * User_ID
      * Message_Color
      * Message_Contents
      * Create_Date

## Front-End
### Admin Tools
1) User Manager
   1) Create
   2) Edit
   3) Delete
   4) Post_Search
      1) User
      2) User/Alias
      3) User/Room
2) Room Manager
   1) Create Room
   2) Edit Posts
   3) Kick User

### User Interface
1) Signup
2) Login
3) Join Room
   1) Select Room
   2) Create Alias
4) Room
   1) Alias_List
   2) Posts
   3) Interaction/Create Post

