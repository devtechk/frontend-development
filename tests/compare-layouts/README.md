# compare-layouts

Comparing rendered HTML pages

## Installation

My system is Ubuntu 16.04 - perhaps there are some other steps to be taken on Windows systems (TODO).

You may also try this installation in a virtual machine. It worked for me on an Ubuntu 16.04 (I hope all dependencies are included here).

Or build a Docker image using the Dockerfile in my frontend-development project.

Some other software is required on a blank Ubuntu system:

```bash
$ sudo apt-get install g++ git imagemagick python
```

Perhaps some other packages might be useful: ```bzip2 curl make openssh-client subversion wget```

Install [Node.js](https://nodejs.org/en/) (my version is 4.4.7, don't use the version from Ubuntu repositories if it is still below 4.x) and use `npm` to install [PhantomJS](http://phantomjs.org), [CasperJS](http://phantomjs.org) and [SlimerJS](https://slimerjs.org):

```bash
$ sudo npm install -g phantomjs-prebuilt casperjs slimerjs
```

The above version number for phantomjs is the npm installer version - it installs PhantomJS 1.9.8.

Now you should clone this repository in a project directory:

```bash
$ git clone https://bitbucket.org/uwegerdes/compare-layouts.git
```

Some node modules have to be installed:

```bash
$ cd compare-layouts
$ npm install
```

If you pull from this repository and get a new version of `package.json` you should run:

```bash
$ npm update
```

## Usage

Start the server:

```bash
$ npm start
```

You can now use your favorite browser to open [http://localhost:3000/app/](http://localhost:3000/app/).

The config file `default.js` uses PhantomJS (headless Webkit) and CasperJS (Firefox) to compare the homepage (index.html) of the application and the /app view generated from the templates in the views directory. This fails usually because the rendering is not identical. But this is only a default test. You may change or remove it if you like.

On the first run there could be an error from SlimerJS: the profile is missing. It is created and the error should not appear again.

Write your own config file(s) to define the pages and elements on the page you want to compare.

The normal use case compares a previous version (use `'cache': true` in the config file) with the actual version (`'cache': false`) using either PhantomJS *OR* SlimerJS. But you may also wish to compare your developement version (with a virtual domain on your PC) with a live version or staging system.

During developement most tests should continue to succeed. The things you develop might fail until they are completed - set both cachings to true to disable the test temporarily. Or you might wish to set both caches to false and use engines PhantomJS and CasperJS to see both rendered results after running the test. If you stop developing that feature simply make a copy of the test, change one to PhantomJS, the other test to CasperJS and set one `"cache"` to `true` and the other to `false`.

## Headless Slimerjs

If you are on a Linux system (Mac might work too) you can switch the execution of SlimerJS to run headles with Xvfb.

```bash
$ sudo apt-get install xvfb
```

The command is built into `compare-layouts.js`.

## Run gulp docker image

Run a container from the image `uwegerdes/gulp-frontend` and connect to your environment (with the localhost ports of gulp livereload on 5381, compare-layouts on 5383 and a running nginx docker container, the hostname `dockerhost` is used in test configs).

This command removes the container after end - useful if your nginx ip address changes.

```bash
$ docker run -it --rm \
	--name compare-layouts \
	-v $(pwd):/usr/src/app \
	-p 5381:5381 \
	-p 5383:5383 \
	--network="$(docker inspect --format='{{.HostConfig.NetworkMode}}' nginx)" \
	--add-host dockerhost:$(docker inspect --format='{{range .NetworkSettings.Networks}}{{.IPAddress}} {{end}}' nginx) \
	uwegerdes/gulp-frontend
```

Open `http://localhost:5383/` in your favourite browser.

Stop the container with CTRL-C and exit the container with CTRL-D.
