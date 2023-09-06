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
  • ->setMessageType($request->type) // Make sure to set a type to one of them ['file','text','voice'] otherwise it will not work!
  
  That's it! You've successfully send a message in LaraMessenger .
# Secondly : Loading The Chat ...

  ## Option 1: Load the chat by chatID
  ```
    return ChatLoader::LoadChatByChatID($ChatID);
  ```

 ## Option 2: Load the chat by UsersIDs
  ```
    return ChatLoader::LoadChatByUsersID($SenderID,$ReceiverID);
  ```

## Option 3: Load the chat by Scrolling
This function will return the chat with the latest message ID to store it and send it again with next request and so on   
    
  ```
    return ChatLoader::LoadChatByScrolling($latestMessageID,$SenderID,$ReceiverID,$NoOfMessagesPerPage);
  ```

Finally I have published the model , migrations and events files to your project ,In case you may like to customize them.

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
