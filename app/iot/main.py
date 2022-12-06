import paho.mqtt.client as mqtt
import json
import os
import time
import sys

# paramètres MQTT
host = 'chirpstack.iut-blagnac.fr'
port = 1883
appid = '1'

try:
    # lit le fichier de configuration
    config_file = os.open('config.json', os.O_RDONLY)
    config_raw = os.read(config_file, 1024)
    config_json = json.loads(config_raw)
    os.close(config_file)

    # charge la configuration
    device = config_json['device']
    data_wanted = config_json['data_wanted']
    alert_values = config_json['alert_values']
    frequency = config_json['frequency']

    # test la configuration
    assert isinstance(device, type([]))
    assert isinstance(data_wanted, type([]))
    assert isinstance(alert_values, type([]))
    assert isinstance(frequency, type(1))
    assert len(data_wanted) == len(alert_values)
except:
    # en cas de problème à la lecture du fichier de configuration on affiche un message et on arrête le programme
    print('Le fichier de configuration ("config.json") est manquant ou mal écrit.')
    sys.exit(1)

# initialise les données JSON
data_json = json.loads('{}')
for data_name in data_wanted:
    data_json[data_name] = 0

# unité et leur nom en français
units = {
    'activity': ["l'activité", 'sur 65535'],
    'co2': ['la concentration en CO2', 'ppm'],
    'humidity': ["l'humidité", 'RH'],
    'illumination': ["l'éclairage", 'lux'],
    'infrared': ["l'infrarouge", 'lux'],
    'infrared_and_visible': ["l'infrarouge et de la lumière visible", 'lux'],
    'pressure': ['la pression', 'hPa'],
    'temperature': ['la température', '°C'],
    'tvoc': ['TVOC', 'ppb']
}

# dernière fois sauvegardé
last_time_saved = 0


def on_connect(client, userdata, flags, rc):
    print(f'Connecté au seveur MQTT "{host}".')
    # s'abonne aux appareils voulus
    for deviceid in device:
        client.subscribe(f'application/{appid}/device/{deviceid}/event/up')


def on_message(client, userdata, msg):
    global last_time_saved
    # prend en compte les données seulement si l'intervalle de lecture est dépassé
    if time.time() - last_time_saved >= frequency * 60:
        payload_json = json.loads(msg.payload)
        # si la clé "object" n'est pas présente on ignore les données
        if 'object' in payload_json.keys():
            data_object = payload_json['object']
            # sauvegarde chaque données voulues
            for data_name in data_wanted:
                data_json[data_name] = data_object[data_name]
                # calcul le dépassement
                alert_value = alert_values[data_wanted.index(data_name)]
                difference = data_json[data_name] - alert_value
                if difference > 0:
                    print(f'Dépassement de la valeur maximale de {units[data_name][0]} ', end='')
                    print(f'({alert_value} {units[data_name][1]}) de {difference} {units[data_name][1]} !')
            # ouvre le fichier de données
            data_file = os.open('data.json', os.O_WRONLY | os.O_CREAT | os.O_TRUNC, 0o644)
            # écrit les valeurs
            data_txt = json.dumps(data_json, indent=4)
            os.write(data_file, data_txt.encode())
            # ferme le fichier de données
            os.close(data_file)
            # met à jour la dernière fois sauvegardé
            last_time_saved = time.time()


client = mqtt.Client()

client.on_connect = on_connect
client.on_message = on_message

client.connect(host, port)

client.loop_forever()