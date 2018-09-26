import collections
import heapq

def contains(small, big):
    for i in xrange(len(big)-len(small)+1):
        for j in xrange(len(small)):
            if big[i+j] != small[j]:
                break
        else:
            return True
    return False

def shortestPath(edges, source, sink):
    queue, visited = [(0, source, [])], set()
    heapq.heapify(queue)
    while queue:
        (cost, node, path) = heapq.heappop(queue)
        if node not in visited:
            visited.add(node)
            path = path + [node]
            if node == sink:
                return (cost, path)
            for c, neighbour in graph[node]:
                if neighbour not in visited:
                    heapq.heappush(queue, (cost+c, neighbour, path))
    return float("inf")

def findReversePath(edges):
	global reversepath
	reversepath=collections.defaultdict(int)
	reversepath[dest]=(0,[])
	for l, r, c in edges:
		if not reversepath[l]:
			reversepath[l]=shortestPath(edges,l,dest)
	
def inputLQ(edges, src, stptemp):
	global LQ
	stpcost, stppath = stptemp
	for i in range(len(stppath)-2,-1,-1):
		j=stppath[i]
		costtemp,pathtemp=shortestPath(edges,src,j)
		for c, neighbour in graph[j]:
			if neighbour not in stppath:
				LQ[neighbour].append((costtemp+c+reversepath[neighbour][0], costtemp+c, pathtemp+[neighbour], costtemp, (1,j), ('active', [])))
				heapq.heapify(LQ[neighbour])
				GQ.append(LQ[neighbour])

def findNextPath():
	while len(GQ)!=0:
		global P
		total=0
		heapq.heapify(GQ)
		temp = heapq.heappop(GQ)
		# print temp
		P = heapq.heappop(temp)
		tail=P[2][len(P[2])-1]
		while P[5][0]=="inactive":
			if len(temp)!=0:
				GQ.append(temp)
			heapq.heapify(GQ)
			temp=heapq.heappop(GQ)
			LQ[tail].append(P)
			GQ.append(LQ[tail])
			P=heapq.heappop(temp)

		if len(temp)!=0:
			GQ.append(temp)

		for i in range(len(edges2)):
			if contains(edges2[i][0], P[2]) and contains(edges2[i][0], listpath[now][1]):
				total+=edges2[i][1]

		while P[2][len(P[2])-1]!=dest:
			LB2=int(total*(1+1/threshold)-listpath[now][0])
			if LB2>P[0]:
				tempLB1=LB2
				adjustPath(P)
				LQ[P[2][len(P[2])-1]].append((tempLB1, P[1], P[2], P[3], P[4], P[5]))
				if LQ[P[2][len(P[2])-1]] not in GQ:
					GQ.append(LQ[P[2][len(P[2])-1]])
				break
			elif not extendPath():
				break

		if P[2][len(P[2])-1]==dest:
			adjustPath(P)
			return (P[1],P[2])

def extendPath():
	global P
	tail=P[2][len(P[2])-1]
	# print P
	# print LQ[tail]
	# print str(GQ)+"\n"
	for x in LQ[tail]:
		(tempLB1, tempLen, tempPath, costtemp, tempCls, tempStatus) = x
		if tempLen>=P[1] and tempCls==P[4]:
			LQ[tail][LQ[tail].index(x)]=(tempLB1, tempLen, tempPath, costtemp, tempCls, ("inactive", []))
			P=((P[0], P[1], P[2], P[3], P[4], ("active", tempPath)))

	for c, neighbour in graph[tail]:
		if neighbour not in P[2] and neighbour!=reversepath[tail][1][1]:
			LQ[neighbour].append((P[0]-reversepath[tail][0]+c+reversepath[neighbour][0], P[1]+c, P[2]+[neighbour], P[3], P[4], P[5]))
			heapq.heapify(LQ[neighbour])
			if LQ[neighbour] not in GQ:
				GQ.append(LQ[neighbour])

	if reversepath[tail][1][1] in P[2]:
		return False
	else:
		P=(P[0], P[1]+reversepath[tail][0]-reversepath[reversepath[tail][1][1]][0], P[2]+[reversepath[tail][1][1]], P[3], P[4], P[5])
		return True

def adjustPath(P):
	if len(listpath)<jumlahstp-1:
		if len(P[5][1])!=0:
			for x in LQ[P[5][1][len(P[5][1])-1]]:
				if x[2]==P[5][1]:
					LQ[P[5][1][len(P[5][1])-1]][LQ[P[5][1][len(P[5][1])-1]].index(x)]=(x[0], x[1], x[2], x[3], x[4], ("active", []))

		if P[2][len(P[2])-1]==dest:
			for i in GQ:
				for j in i:
					for k in range(1, len(j[2])):
						if j[2][k]==P[2][k]:
							print LQ[j[2][len(j[2])-1]][LQ[j[2][len(j[2])-1]].index(j)]
							LQ[j[2][len(j[2])-1]][LQ[j[2][len(j[2])-1]].index(j)]=(j[0], j[1], j[2], j[3], (now+2, j[2][k]), j[5])


edges = [
    ("A", "B", 10),
    ("A", "I", 20),
    ("B", "C", 1),
    ("B", "F", 1),
    ("B", "H", 3),
    ("C", "D", 10),
    ("C", "E", 18),
    ("E", "D", 1),
    ("F", "H", 1),
    ("H", "E", 15),
    ("H", "I", 1),
    ("I", "B", 1)
]
edges2=[]
for x in edges:
	edges2.append(([x[0], x[1]], x[2]))

listpath=[]
GQ=[]
LQ = collections.defaultdict(list)
reversepath=[]
now=0
src=raw_input("Select Source : ")
dest=raw_input("Select Destination : ")
threshold=input("Select Threshold : ")
jumlahstp=input("Select how many shortest path you want : ")

graph = collections.defaultdict(list)
for l, r, c in edges:
	graph[l].append((c,r))

findReversePath(edges)

stptemp=shortestPath(edges, src, dest)
listpath.append(stptemp)

inputLQ(edges, src, stptemp)
heapq.heapify(GQ)

while len(listpath)<=jumlahstp-1 and len(GQ)!=0:
	nextPath=findNextPath()
	for i in range(len(listpath[now][1])):
		if listpath[now][1][i]==nextPath[1][i]:
			lastPlace=listpath[now][1][i]
		else:
			break
	cek0, cek1 = shortestPath(edges, src, lastPlace)
	if float(cek0)/(listpath[now][0]+nextPath[0]-cek0) < float(threshold):
		listpath.append(nextPath)
		now+=1

for x in listpath:
	print x