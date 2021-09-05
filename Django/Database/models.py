from django.db import models

class Test(models.Model):
    id = models.AutoField(db_column='Id', primary_key=True)
    name = models.CharField(db_column='Name', max_length=255)
    age = models.IntegerField(db_column='Age')

    class Meta:
        managed = False
        db_table = 'test'


class Test10000(models.Model):
    id = models.AutoField(db_column='Id', primary_key=True)
    name = models.CharField(db_column='Name', max_length=255)
    age = models.IntegerField(db_column='Age')

    class Meta:
        managed = False
        db_table = 'test10000'


class Test100000(models.Model):
    id = models.AutoField(db_column='Id', primary_key=True)
    name = models.CharField(db_column='Name', max_length=255)
    age = models.IntegerField(db_column='Age')

    class Meta:
        managed = False
        db_table = 'test100000'