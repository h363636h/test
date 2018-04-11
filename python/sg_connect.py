##shotgun
try:
    from shotgun_api3 import Shotgun
except:
    print "no module named Shotgun"


SERVER_PATH = "http://show.macrograph.co.kr"
SCRIPT_NAME = "testapi"
SCRIPT_KEY = "b4332cb2077957915585fafdf27f252bdaf8a3ada1450970d0c69743253de823"

sg = Shotgun(SERVER_PATH, SCRIPT_NAME, SCRIPT_KEY)


assetALL = sg.find('Asset', [['project.Project.name', 'is', 'dst']], ['image', 'code'])

print assetALL