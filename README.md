# Lara-Messenger


![MarkDown](https://img.shields.io/badge/Made%20with-Markdown-1f425f.svg)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![ask me](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

> A simple package for you to implement a chat in your application without effort !

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgements](#acknowledgements)

## Installation

LaraMessenger is a Laravel package that provides messaging functionality for your Laravel application. Follow these steps to get started:

## Step 1: Install the Package

You can install LaraMessenger using Composer. Open your terminal and run the following command:

```
composer require omarabdulwahhab/laramessenger
```

## Step 2: Publish Configuration

To publish the LaraMessenger configuration and assets, use the following Artisan command:

```
php artisan vendor:publish --provider="Omarabdulwahhab\Laramessenger\ServiceProviders\LaraServiceProvider"
```
This command will copy the necessary configuration files to your project, allowing you to customize the package behavior.


## Step 3: Run Migrations

Next, you need to run the migrations to create the necessary database tables for LaraMessenger:

• If you didn't migrate your migrations yet :
```
php artisan migrate
```
• Then :

```
php artisan migrate --path=/database/migrations/LaraMessengerTables
```

```
php artisan migrate --path=/database/migrations/LaraMessengerForeignKeys
```


That's it! You've successfully installed LaraMessenger and set up the necessary database tables for messaging in your Laravel application.



## Usage

# Firstly : Sending The Message
Here you will find how to use this simple package , follow me:
• The code to send a message is very simple :
  ```
    $config = LaraMessenger::builder()
              ->setSenderID($request->sender_id)
              ->setReceiverID($request->receiver_id)
              ->setMessageType($request->type) // Make sure to set a type to one of them ['file','text','voice']
              ->setMessage($request->message)
    // or     ->setMessage($request->file('file'))
    // or     ->setMessage($request->file('voice'))
              ->build();
          /*HERE YOU HAVE TO OPTIONS*/
          // 1- $config->broadcast();
          // OR 
          // 2- $config->send();
  ```

## Option 1: Send a message with broadcasting (pusher) then save the message in the database.

You can use broadcasting with pusher in the package but make sure to integrate with pusher , [read this doc section](https://laravel.com/docs/10.x/broadcasting#pusher-channels)
  ```
    $config->broadcast()
  ```

## Option 1: Send a message without broadcasting (just save the message in the database.)

  ```
  $config->send()
  ```
### notes
>***->setMessageType($request->type) // Make sure to set a type to one of them ['file','text','voice'] otherwise it will not work!***

>***Now , In the updated version of the package $config->send() and $config->broadcast() return the recently stored message.***

That's it! You've successfully send a message in LaraMessenger .

# Secondly : Loading The Chat ...

## Option 1: Load the chat by chatID
### V1.0.0
  ```
    return ChatLoader::LoadChatByChatID($ChatID);
  ```
### V1.1.0
  ```
    $sort = 'desc' // or 'asc'
    return ChatLoader::LoadChatByChatID($ChatID,$sort);
  ```
### notes
>***Now , In the updated version of the package You can now specify the order of retrieved messages. If you want them from oldest to newest, set the $sort variable to 'ASC'or 'asc', the opposite is true for 'DESC' or 'desc'***

>***The default of $sort is 'DESC'.***

## Option 2: Load the chat by UsersIDs
### V1.0.0
  ```
    return ChatLoader::LoadChatByUsersID($SenderID,$ReceiverID);
  ```
### V1.1.0
 ```
    $sort = 'desc' // or 'asc'
    return ChatLoader::LoadChatByUsersID($SenderID,$ReceiverID,$sort);
 ```
### notes
>***Now , In the updated version of the package You can now specify the order of retrieved messages. If you want them from oldest to newest, set the $sort variable to 'ASC'or 'asc', the opposite is true for 'DESC' or 'desc'***

>***The default of $sort is 'DESC'.***

## Option 3: Load the chat by Scrolling
`LoadChatByScrolling` is used to paginate messages efficiently. Instead of loading all messages at once, it loads a limited number of messages per request, improving performance.

### Parameters:

- **`$FirstUserID`** - The first user in the conversation.
- **`$SecondUserID`** - The second user in the conversation.
- **`$LatestMessageID`** *(optional)* - The ID of the last message received. If `null`, it loads the most recent messages.
- **`$no_messages`** *(optional)* - The number of messages to load per request. If `null`, it uses the 10 messages as a default limit.

### How It Works:

1. The first request should pass `null` for `$LatestMessageID` to load the latest messages.
2. Store the last message ID received.
3. For the next request, send the stored `$LatestMessageID` to fetch older messages.

### Example Usage:

```php
// First request (load latest messages)
$messages = ChatLoader::LoadChatByScrolling($user1, $user2);

// Get the last message ID from the response
$latestMessageID = $messages['LatestMessageID'];

// Next request (load older messages)
$olderMessages = ChatLoader::LoadChatByScrolling($user1, $user2, $latestMessageID);

// To get the messages , you must:
return $messages['Messages'];
```

### notes
• The order of parameters has changed in the updated version of the package as below :-

### V1.0.0
```php
public static function LoadChatByScrolling($LatestMessageID,$FirstUserID,$SecondUserID,$no_messages = null)
```
### V1.1.0
```php
public static function LoadChatByScrolling($FirstUserID, $SecondUserID, $LatestMessageID = null, $no_messages = null);
```


Finally I have published the model , migrations and events files to your project ,In case you may like to customize them.
-------------------------------------------------------------------------------------------------------------------------

## 🚀 Updates in Latest Version `V1.1.0`

### **Edit a message** using `editMessage`
- Modify an existing message with `MessageManager::editMessage()`
```php
$bool = MessageManager::editMessage($message->id, 'How are you?!');
```
- Returns `true` if the edit was successful, `false` otherwise.

### **Delete a single message** using `deleteMessage`
- Remove a specific message from the chat.
```php
$bool = MessageManager::deleteMessage($message->id);
```
- Returns `true` if deleted successfully, `false` otherwise.

### **Delete multiple messages at once** using `deleteMessages`
- Pass an array of message IDs to delete multiple messages at once.
```php
$ids = [4, 3, 5];
$bool = MessageManager::deleteMessages($ids);
```
- Returns `true` if all messages were deleted successfully, `false` otherwise.

## Quality Assurance & Testing

This package has been thoroughly tested using **Laravel PHPUnit**, with **16 successful tests** ensuring its stability and high performance.

📌 You can check the test results below:

[![Screenshot-1575.png](https://i.postimg.cc/sxcyNv2M/Screenshot-1575.png)](https://postimg.cc/8fjqFkMG)

## Contributing

We welcome contributions from the community! If you'd like to contribute to this project, please follow these guidelines:

1. **Fork** the repository on GitHub.
2. Create a new branch for your feature or bug fix: `git checkout -b feature/awesome-feature`.
3. Make your changes and commit them: `git commit -am 'Add some feature'`.
4. Push your changes to the branch: `git push origin feature/awesome-feature`.
5. Create a new **Pull Request** (PR) on GitHub, describing your changes and why they should be merged.

Thank you for contributing to our project!


## License

This project is licensed under the MIT License.


## Author

- [OmarAbulwahhab](https://github.com/OmarAbdelwahhab30)

Your support and contributions are greatly appreciated!
