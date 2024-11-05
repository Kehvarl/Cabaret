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
  * command processor?

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
Nickname per room tied to user while in use
  Reserve for an additional length of time


.
