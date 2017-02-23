[![License](https://img.shields.io/github/license/ImpressCMS/impresscms-module-imbuilding.svg?maxAge=2592000)](License.txt) 
	[![GitHub release](https://img.shields.io/github/release/ImpressCMS/impresscms-module-imbuilding.svg?maxAge=2592000)](https://github.com/ImpressCMS/impresscms-module-imbuilding/releases) 
		[![This is ImpressCMS module](https://img.shields.io/badge/ImpressCMS-module-F3AC03.svg?maxAge=2592000)](http://impresscms.org)
#imBuilding
Module to generate base code of new modules  :-)

# Creating ImpressCMS modules the easy way

## Introduction
Creating modules for ImpressCMS is not as easy as it could be. There are many files that need to be there, and quite a bit of conventions need to be followed before the system will work with your module.

Since ImpressCMS 1.3, the imBuilding module aims to help developers with these first steps. The module is nowhere near complete, but it can help you get faster to the point where you start implement the business logic of your module.

## Using imBuilding
imBuilding is an ImpressCMS module that you run on a ImpressCMS website. That means you can run it on a live website, but I wouldn't recommend doing that. 

It would be better to run an ImpressCMS instance locally (the Vagrant box for ImpressCMS is a good way of doing that) and work with that. The prototype modules that are generated by imBuilding can then be integrated in your personal development method.

## the imBuilding workflow
Modules created in imBuilding work with IPF, the ImpressCMS Persistable Framework. imBuilding will help you create the required elements of your module. At the moment, imBuilding supports the creation of multiple modules that contain multiple object types.

A normal workflow to create a new module is as follows:












