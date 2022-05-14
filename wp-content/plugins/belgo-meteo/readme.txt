=== Belgo Meteo ===
Contributors: Benoit De Boeck
Donate link: http://www.worldinmyeyes.be/donate/
Tags: Belgium, Belgique, Belgie, Belgien, weather, meteo, weer, wetter, widget
Requires at least: 3.1
Tested up to: 3.6
Stable tag: 1.0.2
License: GPLv2

Widget displaying Belgian weather info, from IRM/KMI, Meteo Belgique/Meteo Belgie, and meteox.be

== Description ==

Belgo Meteo will display Belgian weather info (current observations and forecast) in a widget.
Several Belgian sources of information are included:

    IRM/KMI (the official Belgian national weather center - www.meteo.be)
    Meteo Belgique/Meteo Belgie (an alternative weather forecast website - www.meteobelgique.be)
    Shower radar (Buien radar - www.meteox.be)

Using Belgian sources of weather information insures that the forecast/observations are the most precise possible.

= Options =

The following options are available to display Belgian weather info in your sidebar.

*Language for display*

Choose here the language for the frontend display. French, Dutch, English, and German are available (except for the Meteo Belgique forecast where only French and Dutch are available - the widget will default to French if English or German is selected in that case).

*Title*

Type here a title of your choice for the widget.
Keep this field empty if you do not want any title.

*Type of info*

Choose here the type of weather info that you want to display:

    IRM forecast
    IRM observations
    IRM observations & forecast
    Meteo Belgique forecast
    Buien Radar rain observations

*Location postcode*

Select your location from this list. Some towns may not be available, simply choose a nearby town.

*Region for IRM forecast*

The IRM forecast is region-based. Please choose the one that includes your location:

    Coast (W)
    Center
    Kempen/Campine (N)
    Ardenne (SE)
    Belgian Lorraine (Extreme SE)

== Installation ==

1. Download the Belgo Meteo zip file and unzip it.
2. Upload the Belgo Meteo folder to your `/wp-content/plugins/` directory. Alternatively, use the Wordpress plugin install in `Plugins >> Add New >> Upload` to upload and install the zip file.
3. Activate the plugin through the `Plugins` menu in WordPress.
4. In the Widgets option, add the Belgo Meteo widget to your chosen sidebar and choose your options.

== Frequently Asked Questions ==

= Can I have several instances of the widget in the sidebar ? =

Yes, you may have several instances of the widget in the sidebar and choose options independently for each of them.

= Why is the Meteo Belgique forecast only displayed in French when I select English or German as display language ? =
 
The weather info from Meteo Belgique/Meteo Belgie is only available in French or Dutch. When you select Meteo Belgique forecasts, the widget will automatically default to French if you choose English or German as display language.

= How can I change the way the weather info is displayed ? =

Belgo Meteo only modifies very slightly the way the weather info is displayed by the various providers. If you want to modify colours or background, for example, you will need to modify the css by modifying/adding the belgometeo.css file.
Please be aware that this file does not contain all css used by the display. Many css rules are left untouched and are coming straight from the providers. You can overrule them by specifying your own css in the belgometeo.css file.

== Screenshots ==

1. Widget options - You may choose the source of weather info as well as a few options, such as display language and location.
2. IRM forecast - This will display the IRM forecast for the region that you have selected.
3. IRM observations - This will display the IRM observations for the location (postcode) that you have selected.
4. Meteo Belgique forecast - This will display the Meteo Belgique forecast for the location (postcode) that you have selected.
5. Buien Radar - This will display the showers radar observations from meteox.be for the whole of Belgium.

== Other notes ==

= Thanks =

Thanks to the generous donators who encourage me to develop my plugins further (and start working on new ones!) by [making a donation](http://www.worldinmyeyes.be/donate/ "Donate").

== Changelog ==

= 1.0.2 =
* Bug fix: completed the missing part of the <a> tag in the Buien Radar unit that was causing the widget following Belgo Meteo to become a link to the Buien Radar website.

= 1.0.1 =
* Bug fix: corrected the path to the css file.

= 1.0 =
* The very first version.

== Upgrade Notice ==

Fixed a bug that was causing the widget following Belgo Meteo to become a link to the Buien Radar website.