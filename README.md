# Uptime Robot for Status Board

Shows your [Uptime Robot](https://uptimerobot.com/) monitors on [Status Board](http://panic.com/statusboard/).

## Configuration

### Requirements

- PHP 5.5+
- [Composer](https://getcomposer.org/)

### Installation

Installation is easy, just download the [master branch zip](https://github.com/yesdevnull/Uptime-Robot-for-Status-Board/archive/master.zip) and move it to where ever you want it.

Next, using Terminal/command-line, install the required codebase by jumping into the directory then running `php composer install`.

### .env Configuration

Finally, you'll need to get your API key from Uptime Robot, along with the IDs of the monitors you want to graph.  If you need to get your API key, [follow this link to find out how to get it](https://uptimerobot.com/api#authentication), otherwise, continue on.

Rename the `.env.example` to `.env` then open it up in a text editor.  If you deleted the `.env.example` file, I'll repeat it below:

```
UR_API_KEY=uXXXXXX-XXXXXXXXXXXXXXXXXXXXXXXX
USE_24H_TIME=true

MONITOR_1_ID=XXXXXXXXX
MONITOR_2_ID=
MONITOR_3_ID=
MONITOR_4_ID=
MONITOR_5_ID=
MONITOR_6_ID=
MONITOR_7_ID=
MONITOR_8_ID=
MONITOR_9_ID=
MONITOR_10_ID=
```

Copy and paste your API key to `UR_API_KEY` so it looks like `UR_API_KEY=<your api key here>`.

If you want to display the graph in 24 hour time, keep the var `USE_24H_TIME=true`, otherwise remove it to use 12 hour time with the meridiem.

Finally, you'll need the IDs for up to 10 monitors.  If you have less than 10 monitors you want to graph, just leave them blank (or remove them.)  To get the ID for a monitor, click on the monitor in the [Uptime Robot Dashboard](https://uptimerobot.com/dashboard.php#mainDashboard).  You'll then see the ID in the URL bar of your web browser, it'll look something like this: `https://uptimerobot.com/dashboard.php#XXXXXXXXX`.  Copy the ID and paste it into your `.env` file.

For now, I limit the maximum number of monitors you can graph to 10, but if you know your way around the code I'm sure you can get around that.

## Comments, Improvements, etc

Open an issue or PR

## License

MIT

