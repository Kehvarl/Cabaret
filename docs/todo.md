# Cabaret

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

