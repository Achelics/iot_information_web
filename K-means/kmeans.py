# -*- coding: utf-8 -*- 
import math
import numpy as np
import pylab as pl
import random as rd
import urllib2   
import re  
import chardet
import MySQLdb
import sys
reload(sys)
sys.setdefaultencoding('utf-8')
 
#计算平面两点的欧氏距离
def distance(a, b):
    return (a[0]- b[0]) ** 2 + (a[1] - b[1]) ** 2

#K均值算法
def k_means(x, y, k_count):
    count = len(x)      #点的个数
    #随机选择K个点
    k = rd.sample(range(count), k_count)
        
    k_point = [[x[i], [y[i]]] for i in k]   #保证有序
    k_point.sort()

    while True:
        km = [[] for i in range(k_count)]      #存储每个簇的索引
        #遍历所有点
        for i in range(count):
            cp = [x[i], y[i]]                   #当前点
            #计算cp点到所有质心的距离
            _sse = [distance(k_point[j], cp) for j in range(k_count)]
            #cp点到那个质心最近
            min_index = _sse.index(min(_sse))   
            #把cp点并入第i簇
            km[min_index].append(i)

        #更换质心
        k_new = []
        for i in range(k_count):
            _x = sum([x[j] for j in km[i]]) / len(km[i])
            _y = sum([y[j] for j in km[i]]) / len(km[i])
            k_new.append([_x, _y])

        k_new.sort()        #排序
        if (k_new != k_point):
            k_point = k_new
        else:
            return km


#计算SSE
def calc_sse(x, y, k_count):
    count = len(x)                              #点的个数
    k = rd.sample(range(count), k_count)        #随机选择K个点
    k_point = [[x[i], [y[i]]] for i in k]   
    k_point.sort()                              #保证有序

    #centroid
    sse = [[] for i in range(k_count)]
    while True:
        ka = [[] for i in range(k_count)]      #存储每个簇的索引
        sse = [[] for i in range(k_count)]
        #遍历所有点
        for i in range(count):
            cp = [x[i], y[i]]                   #当前点
            #计算cp点到所有质心的距离
            _sse = [distance(k_point[j], cp) for j in range(k_count)]
            #cp点到那个质心最近
            min_index = _sse.index(min(_sse))   
            #把cp点并入第i簇
            ka[min_index].append(i)
            sse[min_index].append(min(_sse))

        #更换质心
        k_new = []
        for i in range(k_count):
            _x = sum([x[j] for j in ka[i]]) / len(ka[i])
            _y = sum([y[j] for j in ka[i]]) / len(ka[i])
            k_new.append([_x, _y])

        k_new.sort()        #排序
        #更换质心
        if (k_new != k_point):
            k_point = k_new
        else:
            break

    s =0
    for i in range(k_count):
        s += sum(sse[i])
    return s


x, y = np.loadtxt('F:/MyWeb/iot_information_web/K-means/2.csv', delimiter=',', unpack=True)


#count_total = int(math.sqrt(len(x)))

#k_t = []
#for i in range(1, count_total + 1):
#    s = calc_sse(x, y, i)
#    k_t.append(s)


k_count = 3
km = k_means(x, y, k_count)
#插入数据导数据库当中
try:
    conn=MySQLdb.Connect(host="localhost",user="Achelics",passwd="achelics123",db="iot_information",charset="utf8",port=3306) 
    cursor=conn.cursor()
    #如果数据库表中有数据，先将数据库表中存在的数据删除
    sql_del1 = "delete from data_cluster1"
    sql_del2 = "delete from data_cluster2"
    sql_del3 = "delete from data_cluster3"
    cursor.execute(sql_del1)
    cursor.execute(sql_del2)
    cursor.execute(sql_del3)
    #向数据库表中插入数据
    for i in km[0]:
        sql1="insert into data_cluster1(data_x, data_y) values(%s, %s)"%(x[i],y[i])
        #temp1=(x[i],y[i])
        cursor.execute(sql1)
    for j in km[1]:
        sql2="insert into data_cluster2(data_x, data_y) values(%s, %s)"%(x[j],y[j])
        #temp2=(x[j],y[j])
        cursor.execute(sql2)
    for k in km[2]:
        sql3="insert into data_cluster3(data_x, data_y) values(%s, %s)"%(x[k],y[k])
        #temp3=(x[k],y[k])
        cursor.execute(sql3)

    #获取所有结果
    conn.commit()
    # 关闭指针
    cursor.close()
    # 关闭数据库连接
    conn.close()

except MySQLdb.Error,e:
    print "Mysql Error %d: %s" % (e.args[0], e.args[1])

