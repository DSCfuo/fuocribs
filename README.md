# Fuocribs

Fuocribs  is an open source web project aimed at helping university students find roommates and available accomodation. The overall idea behind this program is to help develop coding and real-world problem-solving skills. This project is beginner friendly because no framework would be used and would be built from scratch so we encourage every contributor to give this project their best shot and also __write down good comments in your codes to help another person reading your code learn and understand fast.__  

## Languages required
* HTML5
* CSS3
* JAVASCRIPT
* PHP
* MYSQL  

## Tools needed
* Web browser
* Text editor    
* You can use any text editor of your choice.
Recommended text editors: [Atom](https://atom.io), [Brackets](https://brackets.io), [Vscode](https://code.visualstudio.com/download) * Offline server ([xampp](https://www.apachefriends.org/download.html) or [wamp](http://www.wampserver.com/en/))  

## Workflow

This section describes the workflow we are going to follow when working in a new feature or fixing a bug. If you want to contribute, please follow these steps:


#### Fork this project
Clone the forked project to your local environment, for example: ```git clone https://github.com/DSCfuo/fuocribs.git ``` (Make sure to replace the URL to your own repository). Add the original project as a remote, for this example the name is upstream, feel free to use whatever name you want. git remote add upstream ```https://github.com/DSCfuo/fuocribs.git ``` Forking the project will create a copy of that project in your own GitHub account, you will commit your work against your own repository.  

#### Updating your local
 In order to update your local environment to the latest version on master, you will have to pull the changes using the upstream repository, for example: git pull upstream master. This will pull all the new commits from the origin repository to your local environment.  

#### Features/Bugs
When working on a new feature, create a new branch feature/something from the master branch, for example feature/login-form. Commit your work against this new branch and push everything to your forked project. Once everything is completed, you should create a pull request to the original project. Make sure to add a description about your work and a link to the trello task.  When fixing a bug, create a new branch fix/something from the master branch, for example fix/css-btn-issues. When completed, push your commits to your forked repository and create a pull request from there. Please make sure to describe what was the problem and how did you fix it.  

#### Updating your local branch
Let's say you've been working on a feature for a couple days, most likely there are new changes in master and your branch is behind. In order to update it to the latest (You might not need/want to do this) you need to pull the latest changes to develop and then rebase your current branch.  $ git checkout master $ git pull upstream master $ git checkout feature/something-awesome $ git rebase master After this, your commits will be on top of the master commits. From here you can push to your origin repository and create a pull request.  You might have some conflicts while rebasing, try to resolve the conflicts for each individual commit. Rebasing is intimidating at the beginning, if you need help don't be afraid to reach out in slack.  

#### Pull requests
In order to merge a pull request, there should be a couple of approval reviews. Once is approved, we should merge to the master branch using the Squash button in github.  When using squash, all the commits will be squashed into one. The idea is to merge features/fixes as oppose of merging each individual commit. This helps when looking back in time for changes in the code base, and if the pull request has a great comment, it's easier to know why that code was introduced.
