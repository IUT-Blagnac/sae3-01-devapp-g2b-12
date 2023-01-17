import paho.mqtt.client as mqtt
import json
import os
import sys
import signal
import time

# test de la configuration
try:
    # vérifie que le fichier existe
    assert os.access('config.json', os.F_OK)
    # vérifie que le script a le droit de lecture sur le fichier
    assert os.access('config.json', os.R_OK)
    # lit le fichier de configuration
    config_file = os.open('config.json', os.O_RDONLY)
    config_raw = os.read(config_file, 1024)
    config_json = json.loads(config_raw)
    os.close(config_file)

    # charge la configuration
    devices = config_json['devices']
    data_wanted = config_json['data_wanted']
    alert_values = config_json['alert_values']
    frequency = config_json['frequency']
    host = config_json['host']
    port = config_json['port']

    # test les options
    assert isinstance(devices, type([]))
    assert all(isinstance(device, str) for device in devices)
    assert len(devices) >= 1
    assert isinstance(data_wanted, type([]))
    assert all(isinstance(data, str) for data in data_wanted)
    assert len(data_wanted) >= 1
    assert isinstance(alert_values, type([]))
    assert all(isinstance(alert_value, (int, float)) for alert_value in alert_values)
    assert len(data_wanted) == len(alert_values)
    assert isinstance(frequency, int)
    assert isinstance(host, str)
    assert isinstance(port, int)
    assert 0 < port < 65536
except:
    # en cas de problème à la lecture du fichier de configuration on affiche un message et on arrête le programme
    print('Le fichier de configuration ("config.json") est manquant, le script n\'a pas le droit de lecture ou la configuration est mal écrite.')
    sys.exit(1)

# initialise les données JSON
data_json = json.loads('{}')
for data_name in data_wanted:
    data_json[data_name] = 0

# chaque unité liée à son nom en français
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


def on_connect(client, userdata, flags, rc):
    """
    Fonction qui est appellée lorsque le programme s'est conecté au serveur MQTT.
    Elle s'occupe de s'abonner au(x) capteur(s) et d'initialiser l'alarme.
    """
    print(f'Connecté au seveur MQTT {host} sur le port {port}.')
    # s'abonne aux appareils voulus
    for device in devices:
        # Le croisillon est un cas spécial qui permet de s'abonner à tout appareil il
        # ne faut pas ajouter "/event/up" lors de l'inscription pour que cela fonctionne
        if device != '#':
            device += '/event/up'
        client.subscribe(f'application/1/device/{device}')
    # définit une alarme
    signal.alarm(frequency*60)


def on_message(client, userdata, msg):
    """
    Fonction qui est appellé à chaque message d'un capteur.
    Elle s'occupe d'enregistrer (dans la mémoire du programme) les données reçues.
    """
    payload_json = json.loads(msg.payload)
    # si la clé "object" n'est pas présente on ignore les données
    # car c'est dans cette élément qu'il y a les données
    if 'object' in payload_json.keys():
        data_object = payload_json['object']
        # sauvegarde chaque donnée voulue
        for data_name in data_wanted:
            data_json[data_name] = data_object[data_name]
        # tests sur le(s) capteur(s) et la/les donnée(s) reçue(s)
        print('-----Capteur :', msg.topic, '-----')
        print('Heure :', time.strftime('%H:%M:%S'))
        print('Données reçues :', data_json)
        # si frequency est 0 on sauvegarde
        if not frequency:
            save_data(None, None)


def save_data(signum, frame):
    """
    Fonction appellée lors d'un signal SIGALRM.
    Elle s'occupe d'avertir sur le dépassement de valaurs de seuil ainsi
    qu'enregistrer les dernières données reçues dans le fichier "data.json" et
    aussi de reprogrammer une alarme.
    """
    # test sur l'heure de l'enregistrement, les données qui vont être enregistrées et les valeurs max
    print('----- Enregistrement -----')
    print('Heure :', time.strftime('%H:%M:%S'))
    print('Données enregistrées :', data_json)
    print("Valeurs d'alerte :", alert_values)
    # calcul le dépassement
    for data_name in data_wanted:
        alert_value = alert_values[data_wanted.index(data_name)]
        difference = data_json[data_name] - alert_value
        if difference > 0:
            print(f'Dépassement de la valeur maximale de {units[data_name][0]} ', end='')
            print(f'({alert_value} {units[data_name][1]}) de {difference} {units[data_name][1]} !')

    # si le fichier existe déjà, mais sans les bons droits alors on affiche un message et ferme le programme
    if os.access('data.json', os.F_OK) and not os.access('data.json', os.W_OK):
        print('Le fichier de données ("data.json") existe mais le script n\'a pas le droit d\'écriture sur le fichier.')
        sys.exit(1)
    # ouvre le fichier de sauvegarde
    data_file = os.open('data.json', os.O_WRONLY | os.O_CREAT | os.O_TRUNC, 0o666)
    # écrit les valeurs
    data_txt = json.dumps(data_json, indent=4)
    os.write(data_file, data_txt.encode())
    # ferme le fichier de sauvegarde
    os.close(data_file)
    # redéfinit l'alarme
    signal.alarm(frequency*60)


# créer un client MQTT
client = mqtt.Client()

# définit une fonction lors de la connexion
client.on_connect = on_connect
# définit une fonction lors d'un message
client.on_message = on_message
# définit une fonction lors d'un signal SIGALRM
signal.signal(signal.SIGALRM, save_data)

# tentative de connexion au serveur
client.connect(host, port)

# boucle infinie de tentative de connexion
client.loop_forever()