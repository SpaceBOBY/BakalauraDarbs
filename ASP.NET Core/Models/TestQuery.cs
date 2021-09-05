using MySqlConnector;
using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Common;
using System.Linq;
using System.Threading.Tasks;

namespace AsynchronousTesting.Models
{
    public class TestQuery
    {
        public AppDb Db { get; }

        public TestQuery(AppDb db)
        {
            Db = db;
        }

        public async Task<Test> FindOneAsync(int id)
        {
            using var cmd = Db.Connection.CreateCommand();
            cmd.CommandText = @"SELECT `Id`, `Name`, `Age` FROM `test` WHERE `Id` = @id";
            cmd.Parameters.Add(new MySqlParameter
            {
                ParameterName = "@id",
                DbType = DbType.Int32,
                Value = id,
            });
            var result = await ReadAllAsync(await cmd.ExecuteReaderAsync());
            return result.Count > 0 ? result[0] : null;
        }

        public async Task<List<Test>> GetAllBigAsync()
        {
            using var cmd = Db.Connection.CreateCommand();
            cmd.CommandText = @"SELECT `Id`, `Name`, `Age` FROM `test100000`;";
            return await ReadAllAsync(await cmd.ExecuteReaderAsync());
        }

        public async Task<List<Test>> GetAllSmallAsync()
        {
            using var cmd = Db.Connection.CreateCommand();
            cmd.CommandText = @"SELECT `Id`, `Name`, `Age` FROM `test10000`;";
            return await ReadAllAsync(await cmd.ExecuteReaderAsync());
        }

        public async Task<List<Test>> LatestPostsAsync()
        {
            using var cmd = Db.Connection.CreateCommand();
            cmd.CommandText = @"SELECT `Id`, `Name`, `Age` FROM `test` ORDER BY `Id` DESC LIMIT 10;";
            return await ReadAllAsync(await cmd.ExecuteReaderAsync());
        }

        public async Task DeleteAsync(int id)
        {
            using var txn = await Db.Connection.BeginTransactionAsync();
            using var cmd = Db.Connection.CreateCommand();
            cmd.CommandText = @"DELETE FROM `test` WHERE `Id` = @id";
            cmd.Parameters.Add(new MySqlParameter
            {
                ParameterName = "@id",
                DbType = DbType.Int32,
                Value = id,
            });
            await cmd.ExecuteNonQueryAsync();
            await txn.CommitAsync();
        }

        private async Task<List<Test>> ReadAllAsync(DbDataReader reader)
        {
            var posts = new List<Test>();
            using (reader)
            {
                while (await reader.ReadAsync())
                {
                    var post = new Test(Db)
                    {
                        Id = reader.GetInt32(0),
                        Name = reader.GetString(1),
                        Age = reader.GetInt32(2),
                    };
                    posts.Add(post);
                }
            }
            return posts;
        }
    }
}
